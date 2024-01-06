<?php

namespace Modules\Payment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaymentTypeRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->has('is_active') &&
                $this->input('is_active') == 'true',
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => ['required', 'string', 'min:1', 'max:100'],
            'is_active' => ['required', 'boolean'],
            'order' => ['nullable', 'integer'],
            'settings' => ['required', 'array', 'min:1', 'max:10'],
            'settings.*.id' => ['nullable', 'integer'],
            'settings.*.key' => ['required', 'string', 'min:1', 'max:100'],
            'settings.*.value' => ['required', 'string', 'min:1', 'max:255'],
            'settings.*.field_type' => ['required', 'string', 'min:1', 'max:50']
        ];

        if ($this->has('_method') && $this->input('_method') == 'PUT') {
            $rules['image'] = $this->file('image') ? ['image', 'max:2048'] : ['string', 'min:5', 'max:255'];
        } else {
            $rules['image'] = ['required', 'image', 'max:2048'];
        }

        return $rules;
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
