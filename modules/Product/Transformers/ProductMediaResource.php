<?php

namespace Modules\Product\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductMediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id"=> $this->id,
            "product_id"=> $this->product_id,
            "url"=> $this->url,
            "order"=> $this->order,
            "file_type" => $this->file_type
        ];
    }
}
