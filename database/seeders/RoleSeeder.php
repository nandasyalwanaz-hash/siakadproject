<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\HakAkses;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // ─────────────────────────────────────────────────────────────────
        // TABEL HAK AKSES
        // Modul: Mahasiswa | Dosen | MataKuliah | KRS | JadwalKuliah | Absensi | Nilai | FuzzyHasil | HakAkses
        //
        // Level  : Admin > Operator > Dosen > Mahasiswa
        // ─────────────────────────────────────────────────────────────────
        $hakAkses = [

            // ── ADMIN: akses penuh semua modul ──────────────────────────
            ['role'=>'Admin','modul'=>'Mahasiswa',   'can_view'=>1,'can_create'=>1,'can_edit'=>1,'can_delete'=>1],
            ['role'=>'Admin','modul'=>'Dosen',        'can_view'=>1,'can_create'=>1,'can_edit'=>1,'can_delete'=>1],
            ['role'=>'Admin','modul'=>'MataKuliah',   'can_view'=>1,'can_create'=>1,'can_edit'=>1,'can_delete'=>1],
            ['role'=>'Admin','modul'=>'KRS',          'can_view'=>1,'can_create'=>1,'can_edit'=>1,'can_delete'=>1],
            ['role'=>'Admin','modul'=>'JadwalKuliah', 'can_view'=>1,'can_create'=>1,'can_edit'=>1,'can_delete'=>1],
            ['role'=>'Admin','modul'=>'Absensi',      'can_view'=>1,'can_create'=>1,'can_edit'=>1,'can_delete'=>1],
            ['role'=>'Admin','modul'=>'Nilai',        'can_view'=>1,'can_create'=>1,'can_edit'=>1,'can_delete'=>1],
            ['role'=>'Admin','modul'=>'FuzzyHasil',   'can_view'=>1,'can_create'=>1,'can_edit'=>1,'can_delete'=>1],
            ['role'=>'Admin','modul'=>'HakAkses',     'can_view'=>1,'can_create'=>1,'can_edit'=>1,'can_delete'=>1],

            // ── OPERATOR: kelola data akademik + hak akses, tidak kelola dosen ──
            ['role'=>'Operator','modul'=>'Mahasiswa',   'can_view'=>1,'can_create'=>1,'can_edit'=>1,'can_delete'=>1],
            ['role'=>'Operator','modul'=>'Dosen',        'can_view'=>1,'can_create'=>0,'can_edit'=>0,'can_delete'=>0],
            ['role'=>'Operator','modul'=>'MataKuliah',   'can_view'=>1,'can_create'=>1,'can_edit'=>1,'can_delete'=>1],
            ['role'=>'Operator','modul'=>'KRS',          'can_view'=>1,'can_create'=>1,'can_edit'=>1,'can_delete'=>1],
            ['role'=>'Operator','modul'=>'JadwalKuliah', 'can_view'=>1,'can_create'=>1,'can_edit'=>1,'can_delete'=>1],
            ['role'=>'Operator','modul'=>'Absensi',      'can_view'=>1,'can_create'=>1,'can_edit'=>1,'can_delete'=>0],
            ['role'=>'Operator','modul'=>'Nilai',        'can_view'=>1,'can_create'=>1,'can_edit'=>1,'can_delete'=>0],
            ['role'=>'Operator','modul'=>'FuzzyHasil',   'can_view'=>1,'can_create'=>1,'can_edit'=>1,'can_delete'=>0],
            ['role'=>'Operator','modul'=>'HakAkses',     'can_view'=>1,'can_create'=>1,'can_edit'=>1,'can_delete'=>1],

            // ── DOSEN: input nilai & absensi, lihat mahasiswa & jadwal ──
            ['role'=>'Dosen','modul'=>'Mahasiswa',   'can_view'=>1,'can_create'=>0,'can_edit'=>0,'can_delete'=>0],
            ['role'=>'Dosen','modul'=>'Dosen',        'can_view'=>0,'can_create'=>0,'can_edit'=>0,'can_delete'=>0],
            ['role'=>'Dosen','modul'=>'MataKuliah',   'can_view'=>1,'can_create'=>0,'can_edit'=>0,'can_delete'=>0],
            ['role'=>'Dosen','modul'=>'KRS',          'can_view'=>1,'can_create'=>0,'can_edit'=>0,'can_delete'=>0],
            ['role'=>'Dosen','modul'=>'JadwalKuliah', 'can_view'=>1,'can_create'=>0,'can_edit'=>0,'can_delete'=>0],
            ['role'=>'Dosen','modul'=>'Absensi',      'can_view'=>1,'can_create'=>1,'can_edit'=>1,'can_delete'=>0],
            ['role'=>'Dosen','modul'=>'Nilai',        'can_view'=>1,'can_create'=>1,'can_edit'=>1,'can_delete'=>0],
            ['role'=>'Dosen','modul'=>'FuzzyHasil',   'can_view'=>1,'can_create'=>1,'can_edit'=>1,'can_delete'=>0],
            ['role'=>'Dosen','modul'=>'HakAkses',     'can_view'=>0,'can_create'=>0,'can_edit'=>0,'can_delete'=>0],

            // ── MAHASISWA: lihat data milik sendiri, daftar KRS ─────────
            ['role'=>'Mahasiswa','modul'=>'Mahasiswa',   'can_view'=>0,'can_create'=>0,'can_edit'=>0,'can_delete'=>0],
            ['role'=>'Mahasiswa','modul'=>'Dosen',        'can_view'=>0,'can_create'=>0,'can_edit'=>0,'can_delete'=>0],
            ['role'=>'Mahasiswa','modul'=>'MataKuliah',   'can_view'=>1,'can_create'=>0,'can_edit'=>0,'can_delete'=>0],
            ['role'=>'Mahasiswa','modul'=>'KRS',          'can_view'=>1,'can_create'=>1,'can_edit'=>0,'can_delete'=>0],
            ['role'=>'Mahasiswa','modul'=>'JadwalKuliah', 'can_view'=>1,'can_create'=>0,'can_edit'=>0,'can_delete'=>0],
            ['role'=>'Mahasiswa','modul'=>'Absensi',      'can_view'=>1,'can_create'=>0,'can_edit'=>0,'can_delete'=>0],
            ['role'=>'Mahasiswa','modul'=>'Nilai',        'can_view'=>1,'can_create'=>0,'can_edit'=>0,'can_delete'=>0],
            ['role'=>'Mahasiswa','modul'=>'FuzzyHasil',   'can_view'=>1,'can_create'=>0,'can_edit'=>0,'can_delete'=>0],
            ['role'=>'Mahasiswa','modul'=>'HakAkses',     'can_view'=>0,'can_create'=>0,'can_edit'=>0,'can_delete'=>0],
        ];

        foreach ($hakAkses as $ha) {
            HakAkses::updateOrCreate(
                ['role' => $ha['role'], 'modul' => $ha['modul']],
                $ha
            );
        }

        // ── User sample per role ─────────────────────────────────────────
        $users = [
            ['name'=>'Admin SIAKAD',  'email'=>'admin@siakad.com',    'password'=>Hash::make('password'), 'role'=>'Admin'],
            ['name'=>'Budi Mahasiswa','email'=>'mhs@siakad.com',      'password'=>Hash::make('password'), 'role'=>'Mahasiswa'],
            ['name'=>'Dr. Sari Dosen','email'=>'dosen@siakad.com',    'password'=>Hash::make('password'), 'role'=>'Dosen'],
            ['name'=>'Operator Sys',  'email'=>'operator@siakad.com', 'password'=>Hash::make('password'), 'role'=>'Operator'],
        ];

        foreach ($users as $u) {
            User::firstOrCreate(['email' => $u['email']], $u);
        }
    }
}
