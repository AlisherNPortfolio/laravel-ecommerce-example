<?php

namespace Modules\Shipping\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShippingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'rules' => ['required', 'array'],
            'rules.*.shipping_id' => ['required', 'integer', 'min:1', 'max:10000'],
            'rules.*.region_id' => ['required', 'integer', 'min:1', 'max:10000'],
            'rules.*.district_id' => ['required', 'integer', 'min:1', 'max:10000'],
            'rules.*.price' => ['required', 'numeric', 'min:0', 'max:1000000'],
            'rules.*.shipping_hours' => ['required', 'integer', 'min:0', 'max:500'],
            'rules.*.has_pickup_address' => ['required', 'boolean'],
            'rules.*.pickup_price' => ['sometimes', 'numeric'],
            'rules.*.pickup_phone' => ['sometimes', 'string'], // TODO: phone regex
            'rules.*.pickup_city' => ['sometimes', 'string', 'max:100'],
            'rules.*.pickup_address' => ['sometimes', 'string']
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
