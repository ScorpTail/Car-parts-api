<?php

namespace App\Http\Requests\Barnd;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // dd($this);
        if ($this->is('admin/*')) {
            return  [
                'brand.name' => ['required', 'min:3', 'max:100'],
                'brand.image_path' => ['required', 'string'],
            ];
        }

        return  [
            'brand.name' => ['required', 'min:3', 'max:100'],
            'brand.image_path' => ['required', 'image', 'max:8192', 'mimes:png,jpg,jpeg,webp'],
        ];
    }
}
