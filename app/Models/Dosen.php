<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';
    
    protected $fillable = [
        'nidn',
        'nama_dosen',
        'email',
        'no_hp',
        'alamat'
    ];

 public function mataKuliah()
    {
        return $this->hasMany(MataKuliah::class);
    }
}