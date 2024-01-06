<?php

namespace Modules\Product\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Common\Services\FileService;

class ProductResource extends JsonResource
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
            "name"=> $this->name,
            "sku"=> $this->sku,
            "slug"=> $this->slug,
            "category_id"=> $this->category_id,
            "brand_id"=> $this->brand_id,
            "price"=> $this->price,
            "discounted_price"=> $this->discounted_price,
            "cost"=> $this->cost,
            "quantity" => $this->quantity,
            "sell_out_of_stock" => $this->sell_out_of_stock,
            "description" => $this->description,
            "meta_keywords" => $this->meta_keywords,
            "meta_description"=> $this->meta_description,
            "measure_type" => $this->measure_type,
            "is_active" => $this->when(auth('admins')->check(), $this->is_active),
            "preview" => $this->preview,
            "is_featured" => $this->is_featured,
            "is_new" => $this->is_new,
            "is_popular" => $this->is_popular,
            "has_warranty" => $this->has_warranty,
            "warranty_period" => $this->warranty_period,
            "tax_rule_id" => $this->tax_rule_id,
            "shipping_id" => $this->shipping_id,
            "images" => ProductMediaResource::collection(
                $this->filterMedia()
            ),
            "videos" => ProductMediaResource::collection(
                $this->filterMedia(FileService::MEDIA_TYPE_VIDEO)
            ),
            "attribute_values" => SkuResource::collection($this->skus)
        ];
    }

    private function filterMedia(int $type = FileService::MEDIA_TYPE_IMAGE)
    {
        return $this->media
                    ->filter(
                        fn($media) => $media->file_type == $type
                    );
    }
}
