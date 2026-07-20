<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dosen;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nidn' => '1101018501', 'nama_dosen' => 'Dr. Ahmad Fauzi, M.Kom',        'email' => 'ahmad.fauzi@dosen.ac.id',        'no_hp' => '081234500001', 'alamat' => 'Jl. A. Yani Km 5, Banjarmasin'],
            ['nidn' => '1102018502', 'nama_dosen' => 'Siti Nurhaliza, M.T',            'email' => 'siti.nurhaliza@dosen.ac.id',     'no_hp' => '081234500002', 'alamat' => 'Jl. Veteran, Banjarmasin'],
            ['nidn' => '1103018503', 'nama_dosen' => 'Muhammad Rizky, M.Kom',          'email' => 'muhammad.rizky@dosen.ac.id',     'no_hp' => '081234500003', 'alamat' => 'Jl. Lambung Mangkurat, Banjarmasin'],
            ['nidn' => '1104018504', 'nama_dosen' => 'Dr. Nurul Hidayah, M.Si',        'email' => 'nurul.hidayah@dosen.ac.id',      'no_hp' => '081234500004', 'alamat' => 'Jl. Sultan Adam, Banjarmasin'],
            ['nidn' => '1105018505', 'nama_dosen' => 'Bambang Setiawan, M.T',          'email' => 'bambang.setiawan@dosen.ac.id',   'no_hp' => '081234500005', 'alamat' => 'Jl. Pramuka, Banjarmasin'],
            ['nidn' => '1106018506', 'nama_dosen' => 'Dewi Anggraini, M.Kom',          'email' => 'dewi.anggraini@dosen.ac.id',     'no_hp' => '081234500006', 'alamat' => 'Jl. Cempaka, Banjarmasin'],
            ['nidn' => '1107018507', 'nama_dosen' => 'Dr. Hendra Gunawan, M.Cs',       'email' => 'hendra.gunawan@dosen.ac.id',     'no_hp' => '081234500007', 'alamat' => 'Jl. S. Parman, Banjarmasin'],
            ['nidn' => '1108018508', 'nama_dosen' => 'Rina Marlina, M.Kom',            'email' => 'rina.marlina@dosen.ac.id',       'no_hp' => '081234500008', 'alamat' => 'Jl. Belitung Darat, Banjarmasin'],
            ['nidn' => '1109018509', 'nama_dosen' => 'Agus Salim, M.T',                'email' => 'agus.salim@dosen.ac.id',         'no_hp' => '081234500009', 'alamat' => 'Jl. Kayu Tangi, Banjarmasin'],
            ['nidn' => '1110018510', 'nama_dosen' => 'Dr. Maya Sari, M.Kom',           'email' => 'maya.sari@dosen.ac.id',          'no_hp' => '081234500010', 'alamat' => 'Jl. Pangeran Antasari, Banjarmasin'],
            ['nidn' => '1111018511', 'nama_dosen' => 'Yusuf Ramadhan, M.Cs',           'email' => 'yusuf.ramadhan@dosen.ac.id',     'no_hp' => '081234500011', 'alamat' => 'Jl. Gatot Subroto, Banjarmasin'],
            ['nidn' => '1112018512', 'nama_dosen' => 'Indah Permatasari, M.T',         'email' => 'indah.permatasari@dosen.ac.id',  'no_hp' => '081234500012', 'alamat' => 'Jl. Ahmad Yani Km 3, Banjarmasin'],
            ['nidn' => '1113018513', 'nama_dosen' => 'Dr. Fajar Nugroho, M.Kom',       'email' => 'fajar.nugroho@dosen.ac.id',      'no_hp' => '081234500013', 'alamat' => 'Jl. Antasari, Banjarmasin'],
            ['nidn' => '1114018514', 'nama_dosen' => 'Wulan Kusuma, M.Si',             'email' => 'wulan.kusuma@dosen.ac.id',       'no_hp' => '081234500014', 'alamat' => 'Jl. RE Martadinata, Banjarmasin'],
            ['nidn' => '1115018515', 'nama_dosen' => 'Andi Saputra, M.T',              'email' => 'andi.saputra@dosen.ac.id',       'no_hp' => '081234500015', 'alamat' => 'Jl. Sutoyo S, Banjarmasin'],
            ['nidn' => '1116018516', 'nama_dosen' => 'Dr. Ratna Dewi, M.Kom',          'email' => 'ratna.dewi@dosen.ac.id',         'no_hp' => '081234500016', 'alamat' => 'Jl. Simpang Ulin, Banjarmasin'],
            ['nidn' => '1117018517', 'nama_dosen' => 'Taufik Hidayat, M.Cs',           'email' => 'taufik.hidayat@dosen.ac.id',     'no_hp' => '081234500017', 'alamat' => 'Jl. Kelayan, Banjarmasin'],
            ['nidn' => '1118018518', 'nama_dosen' => 'Sri Wahyuni, M.T',               'email' => 'sri.wahyuni@dosen.ac.id',        'no_hp' => '081234500018', 'alamat' => 'Jl. Mistar Cokrokusumo, Banjarmasin'],
            ['nidn' => '1119018519', 'nama_dosen' => 'Dr. Dedi Kurniawan, M.Kom',      'email' => 'dedi.kurniawan@dosen.ac.id',     'no_hp' => '081234500019', 'alamat' => 'Jl. Flamboyan, Banjarmasin'],
            ['nidn' => '1120018520', 'nama_dosen' => 'Lestari Handayani, M.Si',        'email' => 'lestari.handayani@dosen.ac.id',  'no_hp' => '081234500020', 'alamat' => 'Jl. Teluk Dalam, Banjarmasin'],
        ];

        foreach ($data as $row) {
            Dosen::firstOrCreate(['nidn' => $row['nidn']], $row);
        }
    }
}
