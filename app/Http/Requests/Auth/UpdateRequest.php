<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
            "email" => "nullable|email|unique:users,email," . Auth::user()->id,
            "password" => "nullable|min:8",
            "no_telp" => "nullable|numeric|digits_between:10,13",
            "image" => "nullable|image|mimes:jpeg,png,jpg|max:2048",
        ];
    }

    public function messages(): array
    {
        return [
            "email.email" => "Email tidak valid",
            "email.unique" => "Email sudah terdaftar",
            "no_telp.numeric" => "Nomor telepon harus berupa angka",
            "no_telp.digits_between" => "Nomor telepon minimal 10 digit dan maksimal 13 digit",
            "password.min" => "Password minimal 8 karakter",
            "image.image" => "File harus berupa gambar",
            "image.mimes" => "File harus berupa jpeg, png, jpg",
            "image.max" => "File maksimal 2MB",
        ];
    }
}
