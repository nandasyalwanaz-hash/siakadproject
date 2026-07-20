<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DosenResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'nidn'       => $this->nidn,
            'nama_dosen' => $this->nama_dosen,
            'email'      => $this->email,
            'no_hp'      => $this->no_hp,
            'alamat'     => $this->alamat,
            'mata_kuliah' => MataKuliahResource::collection($this->whenLoaded('mataKuliah')),
            'jadwal_kuliah' => JadwalKuliahResource::collection($this->whenLoaded('jadwalKuliah')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
