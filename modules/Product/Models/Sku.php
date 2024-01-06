<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    protected $fillable = ['product_id', 'sku', 'quantity', 'price'];

    protected $with = ['attributes'];

    public function attributes()
    {
        return $this->belongsToMany(AttributeValue::class, 'sku_attribute_value')->withPivot('attribute_value_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
