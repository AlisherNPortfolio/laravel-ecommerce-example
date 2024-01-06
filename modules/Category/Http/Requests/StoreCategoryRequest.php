<?php

namespace Modules\Category\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $isActive = $this->input('is_active');
        $this->merge(['is_active' => $isActive == 'true']);

        return [
            'name' => ['required', 'string', 'unique:categories', 'max:100'],
            'parent_id' => ['sometimes', 'nullable', 'integer', 'exists:categories,id'],
            'icon' => ['sometimes', 'image', 'max:1024', 'mimes:png,jpg,bmp,svg'],
            'is_active' => ['required', 'boolean'],
            'order' => ['required', 'integer', 'min:1', 'max:1000'],
            'meta_keywords' => ['sometimes', 'string', 'min:2', 'max:255'],
            'meta_description' => ['sometimes', 'string', 'min:2', 'max:255'],
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
