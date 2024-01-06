<?php

namespace Modules\Payment\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentTypeSetting extends Model
{
    public const FIELD_TYPE_INPUT = 'input';
    public const FIELD_TYPE_CHECKBOX = 'checkbox';
    public const FIELD_TYPE_TEXT = 'textarea';
    // public const FIELD_TYPE_DROPDOWN = 'select';

    protected $fillable = ['payment_type_id', 'key', 'value', 'field_type'];

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }
}
