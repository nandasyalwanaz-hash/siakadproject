<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Mahasiswa extends Model
{
protected $table = 'mahasiswa';
protected $fillable = [
    'nim',
    'nama',
    'tempat_lahir',
    'tanggal_lahir',
    'jenis_kelamin',
    'alamat',
    'agama',
    'no_hp',
    'email',
    'prodi',
    'fakultas',
    'semester',
    'asal_sekolah',
    'nama_ayah',
    'nama_ibu',
    'pekerjaan_ortu'
];


public function krs()
{
    return $this->hasMany(Krs::class);
}
}