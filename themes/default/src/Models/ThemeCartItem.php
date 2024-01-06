<?php

namespace Theme\Default\Models;

use Illuminate\Database\Eloquent\Model;

class ThemeCartItem extends Model
{
    protected $table = 'cart_items';
    protected $fillable = ['cart_id', 'product_id', 'qty'];

    protected $with = ['product'];

    public function cart()
    {
        return $this->belongsTo(ThemeCart::class, 'cart_id');
    }

    public function product()
    {
        return $this->belongsTo(ThemeProduct::class, 'product_id');
    }
}
