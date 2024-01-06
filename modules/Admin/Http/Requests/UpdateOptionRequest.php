<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOptionRequest extends FormRequest
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
        ];
    }

    public function passedValidation(): void
    {
        $this->replace([
            'name' => $this->option['name'],
            'values' => collect($this->option['values'])
                ->filter()
                ->map(fn ($value) => ['value' => $value])
                ->toArray(),
        ]);
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return $this->user()->can("update", $this->route('option'));
        return true;
    }
}
