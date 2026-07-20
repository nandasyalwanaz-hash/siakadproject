<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nilai;
use App\Models\Krs;

class NilaiController extends Controller
{
    public function index()
    {
        $nilai = Nilai::with('krs.mahasiswa', 'krs.mataKuliah')->get();

        return view('nilai.data-nilai', compact('nilai'));
    }

    public function create()
    {
        $krs = Krs::with('mahasiswa', 'mataKuliah')->get();

        return view('nilai.create-nilai', compact('krs'));
    }

    public function store(Request $request)
    {
        // Hitung nilai akhir otomatis: Tugas 30% + UTS 30% + UAS 40%
        $data = $request->all();

        if ($data['nilai_tugas'] && $data['nilai_uts'] && $data['nilai_uas']) {
            $akhir = ($data['nilai_tugas'] * 0.3)
                   + ($data['nilai_uts']   * 0.3)
                   + ($data['nilai_uas']   * 0.4);

            $data['nilai_akhir'] = round($akhir, 2);
            $data['grade']       = $this->hitungGrade($akhir);
        }

        Nilai::create($data);

        return redirect()->route('data-nilai');
    }

    public function edit($id)
    {
        $nilai = Nilai::find($id);
        $krs   = Krs::with('mahasiswa', 'mataKuliah')->get();

        return view('nilai.edit-nilai', compact('nilai', 'krs'));
    }

    public function update(Request $request, $id)
    {
        $nilai = Nilai::find($id);
        $data  = $request->all();

        if ($data['nilai_tugas'] && $data['nilai_uts'] && $data['nilai_uas']) {
            $akhir = ($data['nilai_tugas'] * 0.3)
                   + ($data['nilai_uts']   * 0.3)
                   + ($data['nilai_uas']   * 0.4);

            $data['nilai_akhir'] = round($akhir, 2);
            $data['grade']       = $this->hitungGrade($akhir);
        }

        $nilai->update($data);

        return redirect()->route('data-nilai');
    }

    public function destroy($id)
    {
        Nilai::find($id)->delete();

        return redirect()->route('data-nilai');
    }

    // Helper: konversi angka ke grade huruf
    private function hitungGrade($nilai)
    {
        if ($nilai >= 85) return 'A';
        if ($nilai >= 80) return 'A-';
        if ($nilai >= 75) return 'B+';
        if ($nilai >= 70) return 'B';
        if ($nilai >= 65) return 'B-';
        if ($nilai >= 60) return 'C+';
        if ($nilai >= 55) return 'C';
        if ($nilai >= 40) return 'D';
        return 'E';
    }
}
