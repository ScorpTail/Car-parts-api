<?php

namespace App\Http\Requests\Auth;

use App\Enum\RoleEnum;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3', 'max:20'],
            'email' => ['required', 'string', 'email:rfc,dns', 'ends_with:.com, .net, .ua'],
            'password' => ['required', 'string', 'confirmed', 'min:8', 'max:26', 'regex:/^(?=.*[A-Z])(?=.*\d)/'],
            'role_id' => [new Enum(RoleEnum::class)],
        ];
    }
}
