<?php

namespace App\Http\Requests\CarPart;

use App\Enum\StatusProductEnum;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CarPartRequest extends FormRequest
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
        return [
            'carPart.model_id' => ['required', 'exists:car_models,id'],
            'carPart.article' => ['required', 'integer'],
            'carPart.country_production' => ['required', 'string'],
            'carPart.name' => ['required', 'string', 'min:3', 'max:20'],
            'carPart.description' => ['required', 'string'/*, 'min:100'*/, 'max:1000'],
            'carPart.price' => ['required', 'integer', 'between:0,100000'],
            'carPart.status' => ['required', Rule::enum(StatusProductEnum::class)],
            'carPart.image_path' => ['required'],
            'carPart.image_path.*' => ['required', 'string'],
        ];
    }

    protected function prepareForValidation()
    {
        $carPart = $this->input('carPart');
        $carPart['article'] = random_int(0, 1000000);

        if (is_array($carPart['image_path'])) {
            $carPart['image_path'] = join(',', $carPart['image_path']);
        }

        $this->merge([
            'carPart' => $carPart,
        ]);
    }
}
