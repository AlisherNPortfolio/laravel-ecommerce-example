<?php

namespace Theme\Default\Models;

use App\Traits\LockDB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ThemeAttribute extends Model
{
    use LockDB;
    protected $table = 'attributes';

    protected $guarded = [];

    public function values(): HasMany
    {
        return $this->hasMany(ThemeAttributeValue::class, 'attribute_id');
    }
}
