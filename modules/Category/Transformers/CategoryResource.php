<?php

namespace Modules\Category\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'name' => $this->name,
            'slug' => $this->slug,
            'is_active' => $this->is_active,
            'meta_keywords' => $this->meta_keywords,
            'meta_description' => $this->meta_description,
            'order' => $this->order,
            'position' => $this->position,
            'lft' => $this->lft,
            'rgt' => $this->rgt,
            'icon' => $this->icon,
        ];
    }
}
