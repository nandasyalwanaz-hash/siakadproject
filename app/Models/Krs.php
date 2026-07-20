<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    protected $table = 'krs';

    protected $fillable = [
        'mahasiswa_id',
        'mata_kuliah_id',
        'semester',
        'tahun_akademik',
        'nilai'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class);
    }

    public function dataNilai()
    {
        return $this->hasOne(Nilai::class);
    }

    public function fuzzyHasil()
    {
        return $this->hasOne(FuzzyHasil::class);
    }
}

