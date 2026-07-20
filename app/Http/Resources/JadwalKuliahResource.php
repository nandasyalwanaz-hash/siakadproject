<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JadwalKuliahResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'mata_kuliah_id' => $this->mata_kuliah_id,
            'dosen_id'       => $this->dosen_id,
            'hari'           => $this->hari,
            'jam_mulai'      => $this->jam_mulai,
            'jam_selesai'    => $this->jam_selesai,
            'ruangan'        => $this->ruangan,
            'tahun_akademik' => $this->tahun_akademik,
            'mata_kuliah'    => new MataKuliahResource($this->whenLoaded('mataKuliah')),
            'dosen'          => new DosenResource($this->whenLoaded('dosen')),
            'created_at'     => $this->created_at,
            'updated_at'     => $this->updated_at,
        ];
    }
}
