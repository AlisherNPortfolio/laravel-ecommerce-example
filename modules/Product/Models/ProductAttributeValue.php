<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductAttributeValue extends Model
{
    protected $table = 'product_attribute_value';

    protected $fillable = ['product_id', 'attribute_value_id', 'sku', 'price'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class);
    }
}
