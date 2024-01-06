<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Common\Rules\PictureRule;

class BannerRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $bannerState = $this->input('is_active');
        $this->merge(['is_active' => $this->setState($bannerState)]);

        $bannerItems = $this->input('banners') ?: [];

        if (count($bannerItems) > 0) {
            $banners = [];

            foreach ($bannerItems as $key => $item) {
                $banners[$key] = [...$item, 'is_active' => $this->setState($item)];
            }

            $this->merge(['banners' => $banners]);
        }
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('Store Banners') || $this->user()->can('Update Banners');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:200'],
            'slug' => ['required', 'string', 'max:300', 'unique:banners,slug,'.$this->route()->parameter('banner')],
            'is_active' => ['required', 'boolean'],
            'banners' => ['nullable', 'array'],
            'banners.*.id' => ['nullable', 'integer', 'min:1'],
            'banners.*.title' => ['required', 'string', 'max:255'],
            'banners.*.short_description' => ['nullable', 'string', 'max:500'],
            'banners.*.description' => ['nullable', 'string', 'max:5000'],
            'banners.*.button' => ['nullable', 'string', 'max:50'],
            'banners.*.link' => ['nullable', 'string', 'max:300'],
            'banners.*.image' => [Rule::requiredIf($this->isMethod('POST')), new PictureRule(['png', 'jpg', 'bmp', 'gif', 'svg'])],
            'banners.*.is_active' => ['required', 'boolean'],
            'banners.*.meta_keywords' => ['nullable', 'string', 'max:255'],
            'banners.*.meta_description' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Banner nomi kiritilishi shart',
            'name.max' => 'Banner  nomi kamida 200 belgidan iborat bo\'lishi kerak',
            'slug.required' => 'Slag bo\'lishi shart',
            'slug.max' => 'Slag kamida 300 belgidan iborat bo\'lishi kerak',
            'slug.unique' => 'Slag takrorlanmas bo\'lishi kerak',
            'is_active.required' => 'Banner holati bo\'lishi shart',
            'is_active.in' => 'Banner holati on yoki off qiymatlarini qabul qiladi',
            'banners.array' => 'Banner elementlari massiv shaklida bo\'lishi shart',
            'banners.*.id.required' => 'Banner elementining IDsi berilmagan',
            'banners.*.title.required' => 'Banner elementining sarlavhasi kiritilishi shart',
            'banners.*.title.max' => 'Banner elementining sarlavhasi kamida 255 belgidan iborat bo\'lishi kerak',
            'banners.*.short_description.max' => 'Banner elementining qisqa izohi ko\'pi bilan 500 belgidan iborat bo\'lishi kerak',
            'banners.*.description.max' => 'Banner elementining izohi ko\'pi bilan 5000 belgidan iborat bo\'lishi kerak',
            'banners.*.button.max' => 'Banner elementining tugmasi nomi ko\'pi bilan 50 belgidan iborat bo\'lishi kerak',
            'banners.*.link.max' => 'Banner elementining havolasi ko\'pi bilan 300 belgidan iborat bo\'lishi kerak',
            'banners.*.image.required' => 'Banner elementining rasmi kiritilishi shart',
            'banners.*.image.file' => 'Banner elementining rasmi fayl hisoblanadi',
            'banners.*.image.mimes' => 'Banner elementining rasmi png, jpg, bmp, gif, svg formatlarini qabul qiladi',
            'banners.*.is_active.required' => 'Banner elementining holati bo\'lishi shart',
            'banners.*.is_active.in' => 'Banner elementining holati on yoki off qiymatlarini qabul qiladi',
            'banners.*.meta_keywords.max' => 'Banner elementining meta kalit so\'zlari ko\'pi bilan 50 belgidan iborat bo\'lishi kerak',
            'banners.*.meta_description.max' => 'Banner elementining meta izohi ko\'pi bilan 500 belgidan iborat bo\'lishi kerak',
        ];
    }

    private function setState($val)
    {
        $attribute = is_array($val) ? $val['is_active'] : $val;

        return $attribute === 'true';
    }
}
