<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;

class AbsensiController extends Controller
{
    public function index()
    {
        $absensi = Absensi::with('mahasiswa', 'mataKuliah')->get();

        return view('absensi.data-absensi', compact('absensi'));
    }

    public function create()
    {
        $mahasiswa  = Mahasiswa::all();
        $mataKuliah = MataKuliah::all();

        return view('absensi.create-absensi', compact('mahasiswa', 'mataKuliah'));
    }

    public function store(Request $request)
    {
        Absensi::create($request->all());

        return redirect()->route('data-absensi');
    }

    public function edit($id)
    {
        $absensi    = Absensi::find($id);
        $mahasiswa  = Mahasiswa::all();
        $mataKuliah = MataKuliah::all();

        return view('absensi.edit-absensi', compact('absensi', 'mahasiswa', 'mataKuliah'));
    }

    public function update(Request $request, $id)
    {
        $absensi = Absensi::find($id);
        $absensi->update($request->all());

        return redirect()->route('data-absensi');
    }

    public function destroy($id)
    {
        Absensi::find($id)->delete();

        return redirect()->route('data-absensi');
    }
}
