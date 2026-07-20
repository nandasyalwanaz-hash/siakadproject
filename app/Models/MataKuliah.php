<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
protected $table = 'mata_kuliah';

protected $fillable = [
        'kode_mk',
        'nama_mk',
        'sks',
        'dosen_id'
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function krs()
    {
        return $this->hasMany(Krs::class);
    }
}
