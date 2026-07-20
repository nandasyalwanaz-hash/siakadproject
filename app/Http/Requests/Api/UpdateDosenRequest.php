<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDosenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $dosenId = $this->route('dosen')?->id ?? $this->route('dosen');

        return [
            'nidn'        => 'required|string|max:20|unique:dosen,nidn,' . $dosenId,
            'nama_dosen'  => 'required|string|max:100',
            'email'       => 'required|email|max:100',
            'no_hp'       => 'required|string|max:20',
            'alamat'      => 'required|string',
        ];
    }
}
