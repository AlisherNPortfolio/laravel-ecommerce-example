<?php

namespace Theme\Default\Models;

use App\Traits\LockDB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ThemeAttributeValue extends Model
{
    use LockDB;

    protected $table = 'attribute_values';

    protected $guarded = [];

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(ThemeAttribute::class, 'attribute_id');
    }
}
