<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFuzzyHasilRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'krs_id'                => 'required|exists:krs,id',
            'kehadiran'             => 'required|numeric|min:0|max:100',
            'nilai_tugas'           => 'required|numeric|min:0|max:100',
            'keaktifan_diskusi'     => 'required|numeric|min:0|max:100',
            'hasil_defuzzifikasi'   => 'nullable|numeric',
            'kategori'              => 'nullable|string|max:30',
        ];
    }
}
