<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreKrsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'mahasiswa_id'    => 'required|exists:mahasiswa,id',
            'mata_kuliah_id'  => 'required|exists:mata_kuliah,id',
            'semester'        => 'required|string|max:10',
            'tahun_akademik'  => 'required|string|max:10',
            'nilai'           => 'nullable|string|max:10',
        ];
    }
}
