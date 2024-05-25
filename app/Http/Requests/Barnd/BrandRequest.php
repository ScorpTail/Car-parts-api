<?php

namespace App\Http\Requests\Barnd;

use App\Services\ImageServices\ImageService;
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

    public function __construct(private ImageService $service)
    {
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
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

    protected function prepareForValidation()
    {
        if ($this->is('admin/*')) {
            // Transform the image path using the ImageService
            $image_path = $this->service->relativePath($this->input('brand.image_path'));

            // Merge the transformed image path back into the request
            $this->merge([
                'brand' => [
                    'image_path' => $image_path,
                    'name' => $this->input('brand.name'),
                ]
            ]);
        }
    }
}
