<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMataKuliahRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('mata_kuliah')?->id ?? $this->route('mata_kuliah');

        return [
            'kode_mk'   => 'required|string|max:20|unique:mata_kuliah,kode_mk,' . $id,
            'nama_mk'   => 'required|string|max:100',
            'sks'       => 'required|integer|min:1|max:10',
            'dosen_id'  => 'required|exists:dosen,id',
        ];
    }
}
