<?php

namespace Modules\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Common\Rules\PictureRule;

class StoreProductRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_featured' => $this->has('is_featured') &&
                $this->input('is_featured') == 'true',
            'is_new' => $this->has('is_new') &&
                $this->input('is_new') == 'true',
            'is_popular' => $this->has('is_popular') &&
                $this->input('is_popular') == 'true',
            'has_warranty' => $this->has('has_warranty') &&
                $this->input('has_warranty') == 'true',
            'sell_out_of_stock' => $this->has('sell_out_of_stock') &&
                $this->input('sell_out_of_stock') == 'on',
            'is_active' => $this->has('is_active') &&
                $this->input('is_active'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // dd($this->all());

        return [
            'name' => 'required|string|max:255',
            'description' => ['required', 'string', 'min:10', 'max:50000'],
            'sku' => 'nullable|string|unique:products,sku,'.$this->route()->parameter('product'),
            'quantity' => 'required_if:track_quantity,true|nullable|int',
            'sell_out_of_stock' => 'required_if:track_quantity,true|boolean',
            'category_id' => 'required|int|exists:categories,id',
            'brand_id' => 'required|int|exists:brands,id',
            'price' => 'required|numeric',
            'cost' => 'nullable|numeric',
            'discounted_price' => 'nullable|numeric',
            'is_active' => 'required|boolean',
            'images' => [Rule::requiredIf($this->isMethod('POST')), 'array', 'min:1', 'max:20'],
            'images.*' => [Rule::requiredIf($this->isMethod('POST')), 'max:5120', new PictureRule(['jpg', 'jpeg', 'png', 'bmp', 'svg'])],
            'videos' => ['nullable', 'array', 'max:20'],
            'videos.*' => ['sometimes', 'max:5120', new PictureRule(['mp4'])],
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'measure_type' => 'nullable|string|max:50',
            'preview' => ['required', 'string', 'min:1', 'max:1000'],
            'is_featured' => ['required', 'boolean'],
            'is_new' => ['required', 'boolean'],
            'is_popular' => ['required', 'boolean'],
            'has_warranty' => ['required', 'boolean'],
            'warranty_period' => ['nullable', 'integer', 'max:200'],
            'tax_rule_id' => ['nullable', 'integer', 'min:1', 'max:500'],
            'shipping_id' => ['nullable', 'integer', 'min:1', 'max:500']

        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('Store Product');
    }
}
