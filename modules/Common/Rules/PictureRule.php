<?php

namespace Modules\Common\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\UploadedFile;

class PictureRule implements ValidationRule
{
    protected $data = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $isPutMethod = request()->isMethod('PUT');
        $imageType = [UploadedFile::class];
        if ($isPutMethod) {
            array_push($imageType, 'string');
        }

        if (!$this->checkType($value, $imageType) && !$this->checkMimes($value, $this->data)) {
            $fail(':attribute '.($isPutMethod ? 'url yoki fayl ' : 'fayl').'bo\'lishi kerak');
        }
    }

    private function checkType(mixed $value, array $type): bool
    {
        $validated = [];
        foreach ($type as $pictureType) {
            $validated[] = $value instanceof $pictureType || is_string($value);
        }

        return in_array(true, $validated);
    }

    private function checkMimes(mixed $value, array $mimes): bool
    {
        return is_subclass_of($value, UploadedFile::class) && in_array($value->getClientOriginalExtension(), $mimes);
    }
}
