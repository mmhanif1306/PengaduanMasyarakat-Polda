<?php

namespace App\Http\Requests\Laporan;

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
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'provinsi' => 'required|string',
            'kota' => 'required|string',
            'kecamatan' => 'required|string',
            'kelurahan' => 'required|string',
            'alamat' => 'required|string',
            'longitude' => 'required|string',
            'latitude' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
        ];
    }

    public function messages()
    {
        return [
            'judul.required' => 'Judul harus diisi',
            'judul.string' => 'Judul harus berupa string',
            'judul.max' => 'Judul tidak boleh lebih dari 255 karakter',
            'deskripsi.required' => 'Deskripsi harus diisi',
            'deskripsi.string' => 'Deskripsi harus berupa string',
            'provinsi.required' => 'Provinsi harus diisi',
            'provinsi.string' => 'Provinsi harus berupa string',
            'kota.required' => 'Kota harus diisi',
            'kota.string' => 'Kota harus berupa string',
            'kecamatan.required' => 'Kecamatan harus diisi',
            'kecamatan.string' => 'Kecamatan harus berupa string',
            'kelurahan.required' => 'Kelurahan harus diisi',
            'kelurahan.string' => 'Kelurahan harus berupa string',
            'alamat.required' => 'Alamat harus diisi',
            'alamat.string' => 'Alamat harus berupa string',
            'longitude.required' => 'Longitude harus diisi',
            'longitude.string' => 'Longitude harus berupa string',
            'latitude.required' => 'Latitude harus diisi',
            'latitude.string' => 'Latitude harus berupa string',
            'image.image' => 'Image harus berupa image',
            'image.mimes' => 'Image harus berupa jpeg, png, jpg',
        ];
    }
}
