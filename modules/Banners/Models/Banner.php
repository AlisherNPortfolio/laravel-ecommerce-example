<?php

namespace Modules\Banners\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function banners()
    {
        return $this->hasMany(BannerItem::class);
    }

    public function scopeActive($q)
    {
        return $q->where('is_active', '=', true);
    }

    public function scopeSlug($q, string $slug)
    {
        return $q->where('slug', '=', $slug);
    }
}
