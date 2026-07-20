<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MataKuliah;
use App\Models\Dosen;

class MataKuliahSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua dosen yang sudah ada (urut berdasarkan id)
        $dosenIds = Dosen::orderBy('id')->pluck('id')->all();

        if (empty($dosenIds)) {
            // Jaga-jaga jika DosenSeeder belum dijalankan
            $this->call(DosenSeeder::class);
            $dosenIds = Dosen::orderBy('id')->pluck('id')->all();
        }

        $matkul = [
            ['kode_mk' => 'TIF101', 'nama_mk' => 'Algoritma dan Pemrograman',        'sks' => 3],
            ['kode_mk' => 'TIF102', 'nama_mk' => 'Struktur Data',                    'sks' => 3],
            ['kode_mk' => 'TIF103', 'nama_mk' => 'Basis Data',                       'sks' => 3],
            ['kode_mk' => 'TIF104', 'nama_mk' => 'Pemrograman Berorientasi Objek',   'sks' => 3],
            ['kode_mk' => 'TIF105', 'nama_mk' => 'Pemrograman Web',                  'sks' => 3],
            ['kode_mk' => 'TIF106', 'nama_mk' => 'Pemrograman Mobile',               'sks' => 3],
            ['kode_mk' => 'TIF107', 'nama_mk' => 'Jaringan Komputer',                'sks' => 3],
            ['kode_mk' => 'TIF108', 'nama_mk' => 'Sistem Operasi',                   'sks' => 2],
            ['kode_mk' => 'TIF109', 'nama_mk' => 'Rekayasa Perangkat Lunak',         'sks' => 3],
            ['kode_mk' => 'TIF110', 'nama_mk' => 'Interaksi Manusia dan Komputer',   'sks' => 2],
            ['kode_mk' => 'TIF111', 'nama_mk' => 'Kecerdasan Buatan',                'sks' => 3],
            ['kode_mk' => 'TIF112', 'nama_mk' => 'Machine Learning',                 'sks' => 3],
            ['kode_mk' => 'TIF113', 'nama_mk' => 'Keamanan Jaringan',                'sks' => 2],
            ['kode_mk' => 'TIF114', 'nama_mk' => 'Sistem Informasi Manajemen',       'sks' => 3],
            ['kode_mk' => 'TIF115', 'nama_mk' => 'Basis Data Lanjut',                'sks' => 3],
            ['kode_mk' => 'TIF116', 'nama_mk' => 'Cloud Computing',                  'sks' => 2],
            ['kode_mk' => 'TIF117', 'nama_mk' => 'Matematika Diskrit',               'sks' => 2],
            ['kode_mk' => 'TIF118', 'nama_mk' => 'Statistika',                       'sks' => 2],
            ['kode_mk' => 'TIF119', 'nama_mk' => 'Kalkulus',                         'sks' => 3],
            ['kode_mk' => 'TIF120', 'nama_mk' => 'Fisika Dasar',                     'sks' => 2],
            ['kode_mk' => 'TIF121', 'nama_mk' => 'Manajemen Proyek TI',              'sks' => 2],
            ['kode_mk' => 'TIF122', 'nama_mk' => 'Etika Profesi',                    'sks' => 2],
            ['kode_mk' => 'TIF123', 'nama_mk' => 'Bahasa Inggris',                   'sks' => 2],
            ['kode_mk' => 'TIF124', 'nama_mk' => 'Pendidikan Kewarganegaraan',       'sks' => 2],
            ['kode_mk' => 'TIF125', 'nama_mk' => 'Pendidikan Agama',                 'sks' => 2],
        ];

        foreach ($matkul as $i => $mk) {
            $mk['dosen_id'] = $dosenIds[$i % count($dosenIds)];
            MataKuliah::firstOrCreate(['kode_mk' => $mk['kode_mk']], $mk);
        }
    }
}
