<?php

namespace App\Http\Requests\CarModel;

use Illuminate\Foundation\Http\FormRequest;
use App\Services\ImageServices\ImageService;

class CarModelRequest extends FormRequest
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
                'carModel.brand_id' => ['required', 'exists:brands,id', 'integer'],
                'carModel.name' => ['required', 'min:3', 'max:100'],
                'carModel.image_path' => ['required', 'string'],
            ];
        }
        return [
            'carModel.brand_id' => ['required', 'exists:brands,id', 'integer'],
            'carModel.name' => ['required', 'min:3', 'max:100'],
            'carModel.image_path' => ['required', 'image', 'max:8192', 'mimes:png,jpg,jpeg,webp'],
        ];
    }

    protected function prepareForValidation()
    {
        $carModel = $this->input('carModel');
        if ($this->is('admin/*')) {

            $carModel['image_path'] = $this->service->relativePath($this->input('carModel.image_path'));
        }

        $this->merge(['carModel' => $carModel]);
    }
}
