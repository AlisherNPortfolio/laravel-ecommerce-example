<?php

namespace Theme\Default\Models;

use App\Traits\LockDB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ThemeProduct extends Model
{
    protected $table = 'products';

    use LockDB;

    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'is_new' => 'boolean',
        'is_popular' => 'boolean',
        'has_warranty' => 'boolean',
        'sell_out_of_stock' => 'boolean'
    ];

    protected $with = ['category', 'brand', 'media', 'skus'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ThemeCategory::class, 'category_id', 'id');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(ThemeBrand::class, 'brand_id', 'id');
    }

    public function media(): HasMany
    {
        return $this->hasMany(ThemeProductMedia::class, 'product_id', 'id');
    }

    public function skus(): HasMany
    {
        return $this->hasMany(ThemeSku::class, 'product_id', 'id');
    }

    public function scopeIsActive($query, $isActive = false)
    {
        return $query->where('is_active', $isActive);
    }

    public function scopeIsFeatured($query, $isFeatured = false)
    {
        return $query->where('is_featured', $isFeatured);
    }

    public function scopeIsNew($query, $isNew = false)
    {
        return $query->where('is_new', $isNew);
    }

    public function scopeIsPopular($query, $isPopular = false)
    {
        return $query->where('is_popular', $isPopular);
    }

    public function scopeHasWarranty($query, $hasWarranty = false)
    {
        return $query->where('has_warranty', $hasWarranty);
    }
}
