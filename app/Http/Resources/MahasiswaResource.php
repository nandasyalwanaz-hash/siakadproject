<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MahasiswaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'nim'            => $this->nim,
            'nama'           => $this->nama,
            'tempat_lahir'   => $this->tempat_lahir,
            'tanggal_lahir'  => $this->tanggal_lahir,
            'jenis_kelamin'  => $this->jenis_kelamin,
            'alamat'         => $this->alamat,
            'agama'          => $this->agama,
            'no_hp'          => $this->no_hp,
            'email'          => $this->email,
            'prodi'          => $this->prodi,
            'fakultas'       => $this->fakultas,
            'semester'       => $this->semester,
            'asal_sekolah'   => $this->asal_sekolah,
            'nama_ayah'      => $this->nama_ayah,
            'nama_ibu'       => $this->nama_ibu,
            'pekerjaan_ortu' => $this->pekerjaan_ortu,
            'krs'            => KrsResource::collection($this->whenLoaded('krs')),
            'absensi'        => AbsensiResource::collection($this->whenLoaded('absensi')),
            'created_at'     => $this->created_at,
            'updated_at'     => $this->updated_at,
        ];
    }
}
