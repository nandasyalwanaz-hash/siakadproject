<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreAbsensiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'mahasiswa_id'   => 'required|exists:mahasiswa,id',
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
            'tanggal'        => 'required|date',
            'pertemuan_ke'   => 'required|integer|min:1',
            'status'         => 'required|in:Hadir,Izin,Sakit,Alpha',
            'keterangan'     => 'nullable|string',
        ];
    }
}
