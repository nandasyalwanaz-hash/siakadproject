<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Nilai;
use App\Models\Krs;

class NilaiSeeder extends Seeder
{
    public function run(): void
    {
        $krsList = Krs::orderBy('id')->get();

        if ($krsList->isEmpty()) {
            $this->call(KrsSeeder::class);
            $krsList = Krs::orderBy('id')->get();
        }

        // Variasi nilai tugas/uts/uas agar tidak seragam
        $variasi = [
            ['tugas' => 85, 'uts' => 80, 'uas' => 82],
            ['tugas' => 78, 'uts' => 75, 'uas' => 80],
            ['tugas' => 90, 'uts' => 88, 'uas' => 91],
            ['tugas' => 70, 'uts' => 65, 'uas' => 68],
            ['tugas' => 95, 'uts' => 92, 'uas' => 94],
            ['tugas' => 60, 'uts' => 58, 'uas' => 62],
            ['tugas' => 82, 'uts' => 79, 'uas' => 85],
        ];

        foreach ($krsList as $i => $krs) {
            $v = $variasi[$i % count($variasi)];

            $tugas = $v['tugas'];
            $uts = $v['uts'];
            $uas = $v['uas'];
            $akhir = round(($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4), 2);

            $grade = match (true) {
                $akhir >= 85 => 'A',
                $akhir >= 75 => 'B',
                $akhir >= 65 => 'C',
                $akhir >= 50 => 'D',
                default      => 'E',
            };

            Nilai::firstOrCreate(
                ['krs_id' => $krs->id],
                [
                    'nilai_tugas' => $tugas,
                    'nilai_uts'   => $uts,
                    'nilai_uas'   => $uas,
                    'nilai_akhir' => $akhir,
                    'grade'       => $grade,
                ]
            );
        }
    }
}
