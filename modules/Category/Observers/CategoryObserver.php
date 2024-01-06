<?php

namespace Modules\Category\Observers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Category\Models\Category;

class CategoryObserver
{
    public function creating(Category $category): void
    {
        $parentCategory = Category::query()->find($category->parent_id);
        abort_if(!$parentCategory, 404, 'Parent category not found!');

        $lastChild = $parentCategory->children()->latest('rgt')->first();
        $left = 0;
        $right = 0;

        if ($lastChild) {
            $left = ++$lastChild->rgt;
            $right = $left + 1;
            $order = $lastChild->order + 1;
        } else {
            $left = ++$parentCategory->lft;
            $right = $left + 1;
            $order = 1;
        }

        $category->lft = $left;
        $category->rgt = $right;
        $category->order = $order;
        $category->position = ++$parentCategory->position;
    }

    /**
     * Handle the Category "created" event.
     */
    public function created(Category $category): void
    {
        $parentNodes = $this->getAllParents((int) $category->parent_id);

        $allNextNodes = Category::query()
                        ->where('rgt', '>', --$category->lft)
                        ->whereNotIn('id', collect($parentNodes)->pluck('id'))
                        ->where('id', '!=', $category->id)
                        ->get();

        if (count($allNextNodes) > 0) {
            foreach ($parentNodes as $parentNode) {
                Category::query()->where('id', '=', $parentNode->id)->update([
                    'rgt' => $parentNode->rgt + 2,
                ]);
            }
        }

        if (count($allNextNodes) > 0) {
            foreach ($allNextNodes as $node) {
                $node->lft += 2;
                $node->rgt += 2;
                $node->save();
            }
        }
    }

    /**
     * Handle the Category "updated" event.
     */
    public function updated(Category $category): void
    {
    }

    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Category $category): void
    {
    }

    /**
     * Handle the Category "restored" event.
     */
    public function restored(Category $category): void
    {
    }

    /**
     * Handle the Category "force deleted" event.
     */
    public function forceDeleted(Category $category): void
    {
    }

    private function getAllParents(int $parentId)
    {
        return DB::select("
        with recursive b_tree as (
            select
              t.*
            from categories t
            where t.id = {$parentId} and
                  (
                    (select count(tr.id) from categories tr
                    where tr.parent_id = t.id) > 0)
            union all

            select
              t.*
            from categories as t
              join b_tree as bt on bt.parent_id = t.id
          )
          select * from b_tree
          order by id
        ");
    }
}
