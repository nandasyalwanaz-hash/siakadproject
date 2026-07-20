<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;

class KrsSeeder extends Seeder
{
    public function run(): void
    {
        $mahasiswas = Mahasiswa::orderBy('id')->pluck('id')->all();
        $mataKuliahs = MataKuliah::orderBy('id')->pluck('id')->all();

        if (empty($mahasiswas) || empty($mataKuliahs)) {
            return;
        }

        $totalMk = count($mataKuliahs);

        foreach ($mahasiswas as $index => $mahasiswaId) {
            // Setiap mahasiswa mengambil 1 mata kuliah (index genap) atau 2 mata kuliah (index ganjil)
            $jumlahAmbil = ($index % 2 === 0) ? 1 : 2;

            for ($j = 0; $j < $jumlahAmbil; $j++) {
                $mkIndex = ($index + $j) % $totalMk;
                $mataKuliahId = $mataKuliahs[$mkIndex];

                Krs::firstOrCreate(
                    [
                        'mahasiswa_id'   => $mahasiswaId,
                        'mata_kuliah_id' => $mataKuliahId,
                        'tahun_akademik' => '2025/2026',
                    ],
                    [
                        'semester' => 'Genap',
                        'nilai'    => null,
                    ]
                );
            }
        }
    }
}
