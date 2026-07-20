<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HakAkses extends Model
{
    use HasFactory;

    protected $table = 'hak_akses';

    protected $fillable = [
        'role',
        'modul',
        'can_view',
        'can_create',
        'can_edit',
        'can_delete',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}