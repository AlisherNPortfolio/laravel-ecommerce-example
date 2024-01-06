<?php

namespace Modules\Category\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use Modules\Category\Contracts\Repositories\ICategoryRepository;
use Modules\Category\Transformers\CategoryResource;
use Modules\Common\Services\BaseService;

class CategoryService extends BaseService
{
    public function __construct(private ICategoryRepository $repository)
    {
    }

    public function getAll()
    {
        return $this->repository->all();
    }

    public function getPaginate($id, $perPage = 15)
    {
        [$data, $count] = $this->repository->getPagination($id, $perPage);
        return $this->jsonSuccess([
            'data' => CategoryResource::collection($data->filter(fn ($d) => $d->parent_id)), 
            'count' => $count]
        );
    }

    public function getById($id)
    {
        $category = $this->repository->find($id);
        abort_if(!$category, 404, "Category not found!");

        return $this->jsonSuccess($category);
    }

    public function add(array $data)
    {
        try {
            DB::beginTransaction();

            try {
                $this->repository->create($data);
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                return $this->jsonError($e->getMessage());
            }

            return $this->jsonSuccess(['message' => "Created!"]);
        } catch (Exception $e) {
            return $this->jsonError(
                env_dependend_error($e->getMessage())
            );
        }
    }

    public function update(array $data, int|string $id)
    {
        try {
            $category = $this->repository->find($id);
            abort_if(!$category, 404, "Category not found");

            $category->update($data);

            return $this->jsonSuccess(['message' => "Updated!"]);
        } catch (Exception $e) {
            return $this->jsonError(
                env_dependend_error($e->getMessage())
            );
        }
    }

    public function delete(int $id)
    {
        try {
            $this->repository->delete($id);
            return $this->jsonSuccess(["message"=> "Deleted!"]);
        } catch (Exception $e) {
            return $this->jsonError(
                env_dependend_error($e->getMessage())
            );
        }
    }

    public function tree()
    {
        try {
            $tree = $this->repository->getAsTree();

            return $this->jsonSuccess($tree);
        } catch (Exception $e) {
            return $this->jsonError(
                env_dependend_error($e->getMessage())
            );
        }
    }

    public function refreshTree()
    {

    }
}
