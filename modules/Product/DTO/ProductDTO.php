<?php

namespace Modules\Product\DTO;

use Modules\Common\DTO\BaseDTO;

class ProductDTO extends BaseDTO
{
    public ?int $id;
    public string $name;
    public string $slug;
    public string $sku;
    public float $price;
    public float $discounted_price;
    public float $cost;
    public int $quantity;
    public bool $sell_out_of_stock;
    public string $description;
    public int $category_id;
    public int $brand_id;
    public bool $is_active;
    public string $meta_description;
    public string $meta_keywords;
    public ?string $measure_type;

    public array $images;
    public array $videos;

    public string $preview;
    public bool $is_featured;
    public bool $is_new;
    public bool $is_popular;
    public bool $has_warranty;
    public int $warranty_period;
    public int $tax_rule_id;
    public int $shipping_id;

    public ?array $attribute_values;
}
