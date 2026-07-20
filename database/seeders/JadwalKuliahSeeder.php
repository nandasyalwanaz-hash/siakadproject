<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JadwalKuliah;
use App\Models\MataKuliah;

class JadwalKuliahSeeder extends Seeder
{
    public function run(): void
    {
        $mataKuliahs = MataKuliah::orderBy('id')->get();

        if ($mataKuliahs->isEmpty()) {
            $this->call(MataKuliahSeeder::class);
            $mataKuliahs = MataKuliah::orderBy('id')->get();
        }

        $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        $jamList = [
            ['08:00:00', '10:30:00'],
            ['10:30:00', '13:00:00'],
            ['13:00:00', '15:30:00'],
            ['15:30:00', '18:00:00'],
        ];
        $ruanganList = ['A101', 'A102', 'A103', 'B201', 'B202', 'B203', 'Lab Komputer 1', 'Lab Komputer 2'];

        foreach ($mataKuliahs as $i => $mk) {
            $exists = JadwalKuliah::where('mata_kuliah_id', $mk->id)
                ->where('tahun_akademik', '2025/2026')
                ->exists();

            if ($exists) {
                continue;
            }

            $jam = $jamList[$i % count($jamList)];

            JadwalKuliah::create([
                'mata_kuliah_id' => $mk->id,
                'dosen_id'       => $mk->dosen_id,
                'hari'           => $hariList[$i % count($hariList)],
                'jam_mulai'      => $jam[0],
                'jam_selesai'    => $jam[1],
                'ruangan'        => $ruanganList[$i % count($ruanganList)],
                'tahun_akademik' => '2025/2026',
            ]);
        }
    }
}
