<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreDosenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nidn'        => 'required|string|max:20|unique:dosen,nidn',
            'nama_dosen'  => 'required|string|max:100',
            'email'       => 'required|email|max:100',
            'no_hp'       => 'required|string|max:20',
            'alamat'      => 'required|string',
        ];
    }
}
