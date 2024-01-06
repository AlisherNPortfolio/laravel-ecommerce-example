<?php

namespace Modules\Banners\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'banner_id', 'title', 'short_description',
        'description', 'button', 'link', 'image',
        'meta_keywords', 'meta_description', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function banner()
    {
        return $this->belongsTo(Banner::class);
    }

    public function scopeActive($q)
    {
        return $q->where('is_active', '=', true);
    }

    public function scopeByBanner($q, $banner_id)
    {
        return $q->where('banner_id', '=', $banner_id);
    }
}
