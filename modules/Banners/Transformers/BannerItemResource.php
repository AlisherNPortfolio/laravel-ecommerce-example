<?php

namespace Modules\Banners\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class BannerItemResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'short_description' => $this->description,
            'description' => $this->description,
            'button' => $this->button,
            'link' => $this->link,
            'image' => $this->image,
            'is_active' => $this->is_active,
            'meta_keywords' => $this->meta_keywords,
            'meta_description' => $this->meta_description,
        ];
    }
}
