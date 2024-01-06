<?php

namespace Theme\Default\Models;

use App\Traits\LockDB;
use Illuminate\Database\Eloquent\Model;

class ThemeSku extends Model
{
    use LockDB;

    protected $table = 'skus';

    protected $fillable = ['product_id', 'sku', 'quantity', 'price'];

    protected $with = ['attributes'];

    public function attributes()
    {
        return $this->belongsToMany(ThemeAttributeValue::class, 'sku_attribute_value')->withPivot('attribute_value_id');
    }

    public function product()
    {
        return $this->belongsTo(ThemeProduct::class);
    }
}
