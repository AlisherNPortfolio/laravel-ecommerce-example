<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMedia extends Model
{
    protected $table = 'product_medias';

    use HasFactory;

    protected $fillable = ['product_id', 'url', 'order', 'file_type'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
