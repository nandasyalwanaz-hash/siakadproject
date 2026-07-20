<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FuzzyHasilResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                    => $this->id,
            'krs_id'                => $this->krs_id,
            'kehadiran'             => $this->kehadiran,
            'nilai_tugas'           => $this->nilai_tugas,
            'keaktifan_diskusi'     => $this->keaktifan_diskusi,
            'hasil_defuzzifikasi'   => $this->hasil_defuzzifikasi,
            'kategori'              => $this->kategori,
            'krs'                   => new KrsResource($this->whenLoaded('krs')),
            'created_at'            => $this->created_at,
            'updated_at'            => $this->updated_at,
        ];
    }
}
