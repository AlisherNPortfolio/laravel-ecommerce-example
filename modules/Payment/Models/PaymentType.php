<?php

namespace Modules\Payment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    protected $fillable = ['name', 'image', 'is_active', 'order'];

    protected $with = ['settings'];

    public function settings()
    {
        return $this->hasMany(PaymentTypeSetting::class);
    }
}
