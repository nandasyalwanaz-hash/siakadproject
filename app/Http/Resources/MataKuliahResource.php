<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MataKuliahResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'kode_mk'    => $this->kode_mk,
            'nama_mk'    => $this->nama_mk,
            'sks'        => $this->sks,
            'dosen_id'   => $this->dosen_id,
            'dosen'      => new DosenResource($this->whenLoaded('dosen')),
            'krs'        => KrsResource::collection($this->whenLoaded('krs')),
            'jadwal_kuliah' => JadwalKuliahResource::collection($this->whenLoaded('jadwalKuliah')),
            'absensi'    => AbsensiResource::collection($this->whenLoaded('absensi')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
