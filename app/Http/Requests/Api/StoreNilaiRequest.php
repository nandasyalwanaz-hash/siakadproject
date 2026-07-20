<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreNilaiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'krs_id'       => 'required|exists:krs,id',
            'nilai_tugas'  => 'nullable|numeric|min:0|max:100',
            'nilai_uts'    => 'nullable|numeric|min:0|max:100',
            'nilai_uas'    => 'nullable|numeric|min:0|max:100',
            'nilai_akhir'  => 'nullable|numeric|min:0|max:100',
            'grade'        => 'nullable|string|max:5',
        ];
    }
}
