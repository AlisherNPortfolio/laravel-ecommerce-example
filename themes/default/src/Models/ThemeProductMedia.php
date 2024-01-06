<?php

namespace Theme\Default\Models;

use App\Traits\LockDB;
use Illuminate\Database\Eloquent\Model;

class ThemeProductMedia extends Model
{
    use LockDB;
    protected $table = 'product_medias';

    protected $fillable = [];

    public function product()
    {
        return $this->belongsTo(ThemeProduct::class, 'product_id', 'id');
    }
}
