<?php

namespace Modules\Product\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class SkuResource extends JsonResource
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
            "product_id" => $this->product_id,
            "sku" => $this->sku,
            "quantity" => $this->quantity,
            "price" => $this->price,
            "values" => AttributeValueResource::collection($this->attributes)
        ];
    }
}
