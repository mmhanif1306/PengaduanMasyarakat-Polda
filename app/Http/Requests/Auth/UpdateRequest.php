<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            "email" => "nullable|email|unique:users,email",
            "password" => "nullable|min:8",
            "image" => "nullable|image|mimes:jpeg,png,jpg|max:2048",
        ];
    }

    public function messages(): array
    {
        return [
            "email.email" => "Email tidak valid",
            "email.unique" => "Email sudah terdaftar",
            "password.min" => "Password minimal 8 karakter",
            "image.image" => "File harus berupa gambar",
            "image.mimes" => "File harus berupa jpeg, png, jpg",
            "image.max" => "File maksimal 2MB",
        ];
    }
}
