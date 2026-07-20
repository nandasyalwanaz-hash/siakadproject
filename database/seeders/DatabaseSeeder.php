<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            MahasiswaSeeder::class,
            DosenSeeder::class,
            MataKuliahSeeder::class,
            JadwalKuliahSeeder::class,
            KrsSeeder::class,
            AbsensiSeeder::class,
            NilaiSeeder::class,
        ]);
    }
}
