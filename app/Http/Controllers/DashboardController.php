<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\MataKuliah;
use App\Models\Krs;
use App\Models\Nilai;
use App\Models\Absensi;
use App\Models\JadwalKuliah;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $role = session('role', 'Guest');
        $user = auth()->user();

        return match ($role) {
            'Mahasiswa' => $this->dashboardMahasiswa($user),
            'Dosen'     => $this->dashboardDosen($user),
            'Admin'     => $this->dashboardAdmin(),
            'Operator'  => $this->dashboardOperator(),
            default     => redirect('/login'),
        };
    }

    // ──────────────────────────────────────────────
    // DASHBOARD MAHASISWA
    // ──────────────────────────────────────────────
    private function dashboardMahasiswa($user)
    {
        // Cari data mahasiswa berdasarkan email user
        $mahasiswa = Mahasiswa::where('email', $user->email)->first();

        $stats = [
            'total_sks'     => 0,
            'total_matkul'  => 0,
            'ipk'           => 0,
            'kehadiran'     => 0,
        ];

        $jadwalHariIni  = collect();
        $nilaiTerbaru   = collect();

        if ($mahasiswa) {
            // Total SKS dari KRS (relasi ke mata kuliah)
            $krsList = Krs::where('mahasiswa_id', $mahasiswa->id)
                          ->with('mataKuliah')
                          ->get();

            $stats['total_matkul'] = $krsList->count();
            $stats['total_sks']    = $krsList->sum(fn($k) => optional($k->mataKuliah)->sks ?? 0);

            // IPK dari nilai_akhir
            $nilaiList = Nilai::whereIn('krs_id', $krsList->pluck('id'))->get();
            if ($nilaiList->count() > 0) {
                // Konversi nilai_akhir ke bobot
                $totalBobot = $nilaiList->sum(function ($n) {
                    return $this->nilaiToBobot($n->nilai_akhir);
                });
                $stats['ipk'] = round($totalBobot / $nilaiList->count(), 2);
            }

            // Persentase kehadiran
            $absensiList = Absensi::where('mahasiswa_id', $mahasiswa->id)->get();
            if ($absensiList->count() > 0) {
                $hadir = $absensiList->where('status', 'Hadir')->count();
                $stats['kehadiran'] = round(($hadir / $absensiList->count()) * 100);
            }

            // Jadwal hari ini
            $hariIni = Carbon::now()->locale('id')->isoFormat('dddd');
            $jadwalHariIni = JadwalKuliah::with('mataKuliah', 'dosen')
                ->where('hari', $hariIni)
                ->orderBy('jam_mulai')
                ->get();

            // Nilai terbaru (5 terakhir)
            $nilaiTerbaru = Nilai::with(['krs.mataKuliah'])
                ->whereIn('krs_id', $krsList->pluck('id'))
                ->latest()
                ->take(5)
                ->get();
        }

        return view('dashboard.mahasiswa', compact('mahasiswa', 'stats', 'jadwalHariIni', 'nilaiTerbaru'));
    }

    // ──────────────────────────────────────────────
    // DASHBOARD DOSEN
    // ──────────────────────────────────────────────
    private function dashboardDosen($user)
    {
        $dosen = Dosen::where('email', $user->email)->first();

        $stats = [
            'total_matkul_ajar' => 0,
            'total_mahasiswa'   => 0,
            'belum_dinilai'     => 0,
            'absensi_hari_ini'  => 0,
        ];

        $jadwalHariIni = collect();
        $mahasiswaBelumNilai = collect();

        if ($dosen) {
            // Jadwal hari ini
            $hariIni = Carbon::now()->locale('id')->isoFormat('dddd');
            $jadwalHariIni = JadwalKuliah::with('mataKuliah')
                ->where('dosen_id', $dosen->id)
                ->where('hari', $hariIni)
                ->orderBy('jam_mulai')
                ->get();

            // Total mata kuliah yang diajarkan
            $stats['total_matkul_ajar'] = JadwalKuliah::where('dosen_id', $dosen->id)
                ->distinct('mata_kuliah_id')
                ->count('mata_kuliah_id');

            // Total mahasiswa yang diajar (lewat KRS & jadwal)
            $matkulIds = JadwalKuliah::where('dosen_id', $dosen->id)->pluck('mata_kuliah_id');
            $stats['total_mahasiswa'] = Krs::whereIn('mata_kuliah_id', $matkulIds)
                ->distinct('mahasiswa_id')
                ->count('mahasiswa_id');

            // KRS yang belum dinilai
            $krsIds = Krs::whereIn('mata_kuliah_id', $matkulIds)->pluck('id');
            $sudahDinilai = Nilai::whereIn('krs_id', $krsIds)->pluck('krs_id');
            $stats['belum_dinilai'] = $krsIds->diff($sudahDinilai)->count();

            // Absensi yang diinput hari ini
            $stats['absensi_hari_ini'] = Absensi::whereIn('mata_kuliah_id', $matkulIds)
                ->whereDate('tanggal', today())
                ->count();
        }

        return view('dashboard.dosen', compact('dosen', 'stats', 'jadwalHariIni'));
    }

    // ──────────────────────────────────────────────
    // DASHBOARD ADMIN
    // ──────────────────────────────────────────────
    private function dashboardAdmin()
    {
        $stats = [
            'total_mahasiswa' => Mahasiswa::count(),
            'total_dosen'     => Dosen::count(),
            'total_matkul'    => MataKuliah::count(),
            'total_krs'       => Krs::count(),
        ];

        // Mahasiswa terbaru
        $mahasiswaBaru = Mahasiswa::latest()->take(5)->get();

        // Absensi hari ini semua prodi
        $absensiHariIni = Absensi::whereDate('tanggal', today())->count();

        // Distribusi nilai (untuk mini chart)
        $distribusiNilai = Nilai::selectRaw("grade, count(*) as total")
            ->groupBy('grade')
            ->orderBy('grade')
            ->get()
            ->pluck('total', 'grade');

        return view('dashboard.admin', compact('stats', 'mahasiswaBaru', 'absensiHariIni', 'distribusiNilai'));
    }

    // ──────────────────────────────────────────────
    // DASHBOARD OPERATOR
    // ──────────────────────────────────────────────
private function dashboardOperator()
{
    $stats = [
        'total_mahasiswa' => Mahasiswa::count(),
        'total_matkul'    => MataKuliah::count(),
        'total_krs'       => Krs::count(),
        'absensi_hari_ini'=> Absensi::whereDate('tanggal', today())->count(),
    ];

    $mahasiswaBaru = Mahasiswa::latest()->take(5)->get();

    return view('dashboard.operator', compact('stats', 'mahasiswaBaru'));
}

    // Helper: konversi nilai angka → bobot 4.0
    private function nilaiToBobot($nilai)
    {
        if ($nilai >= 85) return 4.0;
        if ($nilai >= 75) return 3.0;
        if ($nilai >= 65) return 2.0;
        if ($nilai >= 55) return 1.0;
        return 0.0;
    }
}
