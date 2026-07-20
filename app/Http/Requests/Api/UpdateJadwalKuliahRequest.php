<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJadwalKuliahRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'mata_kuliah_id'  => 'required|exists:mata_kuliah,id',
            'dosen_id'        => 'required|exists:dosen,id',
            'hari'            => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat',
            'jam_mulai'       => 'required|date_format:H:i',
            'jam_selesai'     => 'required|date_format:H:i|after:jam_mulai',
            'ruangan'         => 'required|string|max:50',
            'tahun_akademik'  => 'required|string|max:10',
        ];
    }
}
