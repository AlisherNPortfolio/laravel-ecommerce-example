<?php

namespace Theme\Default\Models;

use Illuminate\Database\Eloquent\Model;

class ThemeCart extends Model
{
    protected $table = 'carts';
    protected $fillable = ['user_id'];

    protected $with = ["items"];

    public function items()
    {
        return $this->hasMany(ThemeCartItem::class, 'cart_id');
    }
}
