<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            "nik" => "required|string|digits:16|unique:users,nik",
            "nama" => "required|string|max:255",
            "no_telp" => "required|unique:users,no_telp|digits_between:10,13|regex:/^08[0-9]{8,11}$/",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:8",
            "password_confirmation" => "required|min:8|same:password",
        ];
    }

    public function messages(): array
    {
        return [
            "nik.required" => "NIK wajib diisi",
            "nik.length" => "NIK harus 16 karakter",
            "nik.unique" => "NIK sudah terdaftar",
            "nama.required" => "Nama wajib diisi",
            "nama.string" => "Nama harus berupa string",
            "nama.max" => "Nama maksimal 255 karakter",
            "no_telp.required" => "Nomor telepon wajib diisi",
            "no_telp.regex" => "Nomor telepon tidak valid",
            "no_telp.unique" => "Nomor telepon sudah terdaftar",
            "no_telp.digits_between" => "Nomor telepon minimal 10 digit dan maksimal 13 digit",
            "email.required" => "Email wajib diisi",
            "email.email" => "Email tidak valid",
            "email.unique" => "Email sudah terdaftar",
            "password.required" => "Password wajib diisi",
            "password.min" => "Password minimal 8 karakter",
            "password_confirmation.required" => "Konfirmasi password wajib diisi",
            "password_confirmation.min" => "Konfirmasi password minimal 8 karakter",
            "password_confirmation.same" => "Konfirmasi password tidak sama dengan password",
        ];
    }
}
