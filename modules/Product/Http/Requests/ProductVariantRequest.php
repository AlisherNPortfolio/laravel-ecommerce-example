<?php

namespace Modules\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductVariantRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "product_id"=> ['required', 'integer', 'min:1', 'max:1000000'],
            "variants" => ["required", "array"],
            "variants.*.name" => ['required', 'string', 'min:1', 'max:100'],
            "variants.*.sku" => ["required", "string","min:1","max:100"],
            "variants.*.quantity" => ["required", "integer", "min:0", "max:1000000"],
            "variants.*.price" => ["required", "numeric","min:0","max:100000000"],
            "variants.*.values" => ['required', 'array'],
            "variants.*.values.*" => ["required", "integer"],
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
