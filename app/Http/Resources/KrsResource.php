<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KrsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'mahasiswa_id'   => $this->mahasiswa_id,
            'mata_kuliah_id' => $this->mata_kuliah_id,
            'semester'       => $this->semester,
            'tahun_akademik' => $this->tahun_akademik,
            'nilai'          => $this->nilai,
            'mahasiswa'      => new MahasiswaResource($this->whenLoaded('mahasiswa')),
            'mata_kuliah'    => new MataKuliahResource($this->whenLoaded('mataKuliah')),
            'data_nilai'     => new NilaiResource($this->whenLoaded('dataNilai')),
            'fuzzy_hasil'    => new FuzzyHasilResource($this->whenLoaded('fuzzyHasil')),
            'created_at'     => $this->created_at,
            'updated_at'     => $this->updated_at,
        ];
    }
}
