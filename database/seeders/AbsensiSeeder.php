<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Absensi;
use App\Models\Krs;
use Carbon\Carbon;

class AbsensiSeeder extends Seeder
{
    public function run(): void
    {
        $krsList = Krs::orderBy('id')->get();

        if ($krsList->isEmpty()) {
            $this->call(KrsSeeder::class);
            $krsList = Krs::orderBy('id')->get();
        }

        $statusList = ['Hadir', 'Hadir', 'Hadir', 'Izin', 'Sakit', 'Alpha'];
        $keteranganMap = [
            'Hadir' => null,
            'Izin'  => 'Izin keperluan keluarga',
            'Sakit' => 'Sakit, ada surat keterangan dokter',
            'Alpha' => 'Tidak ada keterangan',
        ];

        $baseDate = Carbon::create(2026, 3, 2); // Senin, awal semester genap

        foreach ($krsList as $i => $krs) {
            $status = $statusList[$i % count($statusList)];
            $pertemuanKe = ($i % 4) + 1;

            Absensi::firstOrCreate(
                [
                    'mahasiswa_id'   => $krs->mahasiswa_id,
                    'mata_kuliah_id' => $krs->mata_kuliah_id,
                    'pertemuan_ke'   => $pertemuanKe,
                ],
                [
                    'tanggal'    => $baseDate->copy()->addWeeks($pertemuanKe - 1)->toDateString(),
                    'status'     => $status,
                    'keterangan' => $keteranganMap[$status],
                ]
            );
        }
    }
}
