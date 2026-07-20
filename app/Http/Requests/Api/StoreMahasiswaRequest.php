<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreMahasiswaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nim'             => 'required|string|max:20|unique:mahasiswa,nim',
            'nama'            => 'required|string|max:100',
            'tempat_lahir'    => 'required|string|max:100',
            'tanggal_lahir'   => 'required|date',
            'jenis_kelamin'   => 'required|in:L,P',
            'alamat'          => 'required|string',
            'agama'           => 'required|string|max:20',
            'no_hp'           => 'required|string|max:20',
            'email'           => 'required|email|max:100',
            'prodi'           => 'required|string|max:100',
            'fakultas'        => 'required|string|max:100',
            'semester'        => 'required|integer|min:1|max:14',
            'asal_sekolah'    => 'required|string|max:100',
            'nama_ayah'       => 'required|string|max:100',
            'nama_ibu'        => 'required|string|max:100',
            'pekerjaan_ortu'  => 'required|string|max:100',
        ];
    }
}
