<?php

namespace Theme\Default\Models;

use App\Traits\LockDB;
use App\Utils\NestedSet\NestedSet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ThemeCategory extends Model
{
    use NestedSet;
    use LockDB;

    protected $table = 'categories';

    protected $displayOtherFields = ['id', 'parent_id', 'slug', 'icon', 'is_active', 'order', 'lft', 'rgt', 'position'];

    protected $fillable = [];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(ThemeProduct::class, 'category_id', 'id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}
