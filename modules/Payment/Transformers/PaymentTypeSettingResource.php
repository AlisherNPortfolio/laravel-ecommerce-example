<?php

namespace Modules\Payment\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentTypeSettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'payment_type_id' => $this->payment_type_id,
            'key' => $this->key,
            'value' => $this->value,
            'field_type' => $this->field_type
        ];
    }
}
