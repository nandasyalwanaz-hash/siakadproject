<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalKuliah;
use App\Models\MataKuliah;
use App\Models\Dosen;

class JadwalKuliahController extends Controller
{
    public function index()
    {
        $jadwal = JadwalKuliah::with('mataKuliah', 'dosen')->get();

        return view('jadwal_kuliah.data-jadwal', compact('jadwal'));
    }

    public function create()
    {
        $mataKuliah = MataKuliah::all();
        $dosen      = Dosen::all();

        return view('jadwal_kuliah.create-jadwal', compact('mataKuliah', 'dosen'));
    }

    public function store(Request $request)
    {
        JadwalKuliah::create($request->all());

        return redirect()->route('data-jadwal');
    }

    public function edit($id)
    {
        $jadwal     = JadwalKuliah::find($id);
        $mataKuliah = MataKuliah::all();
        $dosen      = Dosen::all();

        return view('jadwal_kuliah.edit-jadwal', compact('jadwal', 'mataKuliah', 'dosen'));
    }

    public function update(Request $request, $id)
    {
        $jadwal = JadwalKuliah::find($id);
        $jadwal->update($request->all());

        return redirect()->route('data-jadwal');
    }

    public function destroy($id)
    {
        JadwalKuliah::find($id)->delete();

        return redirect()->route('data-jadwal');
    }
}
