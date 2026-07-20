<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreMataKuliahRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kode_mk'   => 'required|string|max:20|unique:mata_kuliah,kode_mk',
            'nama_mk'   => 'required|string|max:100',
            'sks'       => 'required|integer|min:1|max:10',
            'dosen_id'  => 'required|exists:dosen,id',
        ];
    }
}
