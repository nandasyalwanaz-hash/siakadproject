<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NilaiResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'krs_id'       => $this->krs_id,
            'nilai_tugas'  => $this->nilai_tugas,
            'nilai_uts'    => $this->nilai_uts,
            'nilai_uas'    => $this->nilai_uas,
            'nilai_akhir'  => $this->nilai_akhir,
            'grade'        => $this->grade,
            'krs'          => new KrsResource($this->whenLoaded('krs')),
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at,
        ];
    }
}
