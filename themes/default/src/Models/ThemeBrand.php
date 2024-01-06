<?php

namespace Theme\Default\Models;

use App\Traits\LockDB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ThemeBrand extends Model
{
    use LockDB;

    protected $table = 'brands';

    protected $fillable = [];

    public function products(): HasMany
    {
        return $this->hasMany(ThemeProduct::class, 'brand_id', 'id');
    }
}
