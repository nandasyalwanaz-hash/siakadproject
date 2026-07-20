<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreHakAksesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'role'       => 'required|string|max:50',
            'modul'      => 'required|string|max:50',
            'can_view'   => 'required|boolean',
            'can_create' => 'required|boolean',
            'can_edit'   => 'required|boolean',
            'can_delete' => 'required|boolean',
        ];
    }
}
