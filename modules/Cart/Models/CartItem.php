<?php

namespace Modules\Cart\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Product\Models\Product;

class CartItem extends Model
{
    protected $fillable = ['cart_id', 'product_id', 'qty'];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
