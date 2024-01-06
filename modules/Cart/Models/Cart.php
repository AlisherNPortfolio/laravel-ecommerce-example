<?php

namespace Modules\Cart\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id'];

    protected $casts = [
        "is_completed" => "boolean"
    ];

    protected $with = ["items"];

    public function items()
    {
        return $this->allItems()->where('is_completed', true);
    }

    public function allItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
