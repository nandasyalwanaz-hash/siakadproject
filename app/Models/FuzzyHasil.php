<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuzzyHasil extends Model
{
    protected $table = 'fuzzy_hasil';

    protected $fillable = [
        'krs_id',
        'kehadiran',
        'nilai_tugas',
        'keaktifan_diskusi',
        'hasil_defuzzifikasi',
        'kategori',
    ];

    public function krs()
    {
        return $this->belongsTo(Krs::class);
    }
}
