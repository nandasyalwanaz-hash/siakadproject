<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AbsensiResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'mahasiswa_id'   => $this->mahasiswa_id,
            'mata_kuliah_id' => $this->mata_kuliah_id,
            'tanggal'        => $this->tanggal,
            'pertemuan_ke'   => $this->pertemuan_ke,
            'status'         => $this->status,
            'keterangan'     => $this->keterangan,
            'mahasiswa'      => new MahasiswaResource($this->whenLoaded('mahasiswa')),
            'mata_kuliah'    => new MataKuliahResource($this->whenLoaded('mataKuliah')),
            'created_at'     => $this->created_at,
            'updated_at'     => $this->updated_at,
        ];
    }
}
