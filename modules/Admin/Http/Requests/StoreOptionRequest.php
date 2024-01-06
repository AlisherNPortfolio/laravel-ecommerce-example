<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Product\Models\Option;

class StoreOptionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'option.name' => ['required', 'string'],
            'option.values' => ['required', 'array', 'min:1'],
            'option.values.*' => [
                'sometimes', 'nullable', 'string', 'distinct:ignore_case', 'max:255',
            ],
            'options' => ['nullable', 'array'],
            'options.*' => ['int', 'exists:options,id'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return $this->user()->can('Store Option', Option::class);
        return true;
    }

    protected function passedValidation()
    {
        $this->replace([
            'name' => $this->option['name'],
            'values' => collect($this->option['values'])
                ->filter()
                ->map(fn ($value) => ['value' => $value])
                ->toArray(),
        ]);
    }

    public function messages(): array
    {
        return [
            'option.name.required' => 'Variant nomi kiritilishi shart',
            'option.values.*.string' => 'Variant qiymatiga matn kiritilishi shart',
        ];
    }
}
