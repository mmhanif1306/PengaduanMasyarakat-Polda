<?php

namespace App\Http\Requests\Laporan;

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
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'provinsi' => 'required|string',
            'kota' => 'required|string',
            'kecamatan' => 'required|string',
            'kelurahan' => 'required|string',
            'alamat' => 'required|string',
            'longitude' => 'required|string',
            'latitude' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required' => 'Judul laporan harus diisi',
            'judul.string' => 'Judul laporan harus berupa string',
            'judul.max' => 'Judul laporan maksimal 255 karakter',
            'deskripsi.required' => 'Deskripsi laporan harus diisi',
            'deskripsi.string' => 'Deskripsi laporan harus berupa string',
            'provinsi.required' => 'Provinsi laporan harus diisi',
            'provinsi.string' => 'Provinsi laporan harus berupa string',
            'kota.required' => 'Kota laporan harus diisi',
            'kota.string' => 'Kota laporan harus berupa string',
            'kecamatan.required' => 'Kecamatan laporan harus diisi',
            'kecamatan.string' => 'Kecamatan laporan harus berupa string',
            'kelurahan.required' => 'Kelurahan laporan harus diisi',
            'kelurahan.string' => 'Kelurahan laporan harus berupa string',
            'alamat.required' => 'Alamat laporan harus diisi',
            'alamat.string' => 'Alamat laporan harus berupa string',
            'longitude.required' => 'Longitude laporan harus diisi',
            'longitude.string' => 'Longitude laporan harus berupa string',
            'latitude.required' => 'Latitude laporan harus diisi',
            'latitude.string' => 'Latitude laporan harus berupa string',
            'image.required' => 'Gambar laporan harus diisi',
            'image.image' => 'Gambar laporan harus berupa gambar',
            'image.mimes' => 'Gambar laporan harus berupa jpeg, png, jpg',
        ];
    }
}
