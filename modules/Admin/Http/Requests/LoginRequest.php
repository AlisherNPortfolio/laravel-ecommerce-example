<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:6', 'max:30'],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Elektron pochta kiritilishi shart',
            'email.email' => 'Noto\'g\'ri formatdagi elektron pochta kiritdingiz',
            'password.required' => 'Parol kiritilishi shart',
            'password.min' => 'Parol kamida 6ta belgidan iborat bo\'lishi kerak',
            'password.max' => 'Parol ko\'pi bilan 30ta belgidan iborat bo\'lishi kerak'
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
