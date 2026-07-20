<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HakAksesResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'role'       => $this->role,
            'modul'      => $this->modul,
            'can_view'   => $this->can_view,
            'can_create' => $this->can_create,
            'can_edit'   => $this->can_edit,
            'can_delete' => $this->can_delete,
            'users'      => UserResource::collection($this->whenLoaded('users')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
