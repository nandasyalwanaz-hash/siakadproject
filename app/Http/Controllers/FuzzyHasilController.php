<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Krs;
use App\Models\Absensi;
use App\Models\FuzzyHasil;
use App\Services\FuzzyMamdaniService;

class FuzzyHasilController extends Controller
{
    protected FuzzyMamdaniService $fuzzy;

    public function __construct(FuzzyMamdaniService $fuzzy)
    {
        $this->fuzzy = $fuzzy;
    }

    /**
     * Daftar KRS beserta status evaluasi fuzzy-nya (sudah/belum dievaluasi).
     */
    public function index()
    {
        $krsList = Krs::with(['mahasiswa', 'mataKuliah', 'fuzzyHasil'])->get();

        return view('fuzzy_hasil.data-fuzzy-hasil', compact('krsList'));
    }

    /**
     * Form input evaluasi fuzzy untuk 1 KRS tertentu.
     * Kehadiran & nilai tugas di-prefill otomatis dari tabel absensi & nilai,
     * keaktifan diskusi diinput manual oleh dosen.
     */
    public function create($krsId)
    {
        $krs = Krs::with(['mahasiswa', 'mataKuliah', 'dataNilai', 'fuzzyHasil'])->findOrFail($krsId);

        // Prefill nilai tugas dari tabel nilai (jika sudah diinput)
        $nilaiTugas = optional($krs->dataNilai)->nilai_tugas;

        // Prefill kehadiran (%) dari tabel absensi:
        // (jumlah status "Hadir" ÷ total pertemuan tercatat) × 100
        $totalPertemuan = Absensi::where('mahasiswa_id', $krs->mahasiswa_id)
            ->where('mata_kuliah_id', $krs->mata_kuliah_id)
            ->count();

        $totalHadir = Absensi::where('mahasiswa_id', $krs->mahasiswa_id)
            ->where('mata_kuliah_id', $krs->mata_kuliah_id)
            ->where('status', 'Hadir')
            ->count();

        $kehadiran = $totalPertemuan > 0
            ? round(($totalHadir / $totalPertemuan) * 100, 2)
            : 0;

        return view('fuzzy_hasil.create-fuzzy-hasil', compact('krs', 'kehadiran', 'nilaiTugas', 'totalPertemuan', 'totalHadir'));
    }

    /**
     * Jalankan FuzzyMamdaniService lalu simpan hasilnya ke tabel fuzzy_hasil.
     */
    public function store(Request $request)
    {
        $request->validate([
            'krs_id'             => 'required|exists:krs,id',
            'kehadiran'          => 'required|numeric|min:0|max:100',
            'nilai_tugas'        => 'required|numeric|min:0|max:100',
            'keaktifan_diskusi'  => 'required|numeric|min:0|max:100',
        ]);

        $hasil = $this->fuzzy->hitung(
            (float) $request->kehadiran,
            (float) $request->nilai_tugas,
            (float) $request->keaktifan_diskusi
        );

        // updateOrCreate: kalau KRS ini sudah pernah dievaluasi, hasilnya di-update (evaluasi ulang)
        $fuzzyHasil = FuzzyHasil::updateOrCreate(
            ['krs_id' => $request->krs_id],
            [
                'kehadiran'           => $request->kehadiran,
                'nilai_tugas'         => $request->nilai_tugas,
                'keaktifan_diskusi'   => $request->keaktifan_diskusi,
                'hasil_defuzzifikasi' => $hasil['skor'],
                'kategori'            => $hasil['kategori'],
            ]
        );

        return redirect()->route('show-fuzzy-hasil', $fuzzyHasil->id)
            ->with('success', 'Evaluasi fuzzy berhasil dihitung dan disimpan.');
    }

    /**
     * Detail hasil evaluasi: skor crisp, kategori, dan breakdown transparan
     * (fuzzifikasi tiap variabel + rule mana saja yang aktif + alpha-nya).
     */
    public function show($id)
    {
        $fuzzyHasil = FuzzyHasil::with(['krs.mahasiswa', 'krs.mataKuliah'])->findOrFail($id);

        // Hitung ulang breakdown dari input mentah yang tersimpan (tidak perlu
        // simpan JSON besar di DB, cukup 3 input + hasil akhir).
        $detail = $this->fuzzy->hitung(
            (float) $fuzzyHasil->kehadiran,
            (float) $fuzzyHasil->nilai_tugas,
            (float) $fuzzyHasil->keaktifan_diskusi
        );

        return view('fuzzy_hasil.show-fuzzy-hasil', compact('fuzzyHasil', 'detail'));
    }

    public function destroy($id)
    {
        FuzzyHasil::findOrFail($id)->delete();

        return redirect()->route('data-fuzzy-hasil')->with('success', 'Hasil evaluasi fuzzy dihapus.');
    }
}
