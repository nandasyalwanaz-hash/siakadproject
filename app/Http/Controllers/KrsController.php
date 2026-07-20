<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;

class KrsController extends Controller
{
    public function index()
    {
        $krs = Krs::with('mahasiswa', 'mataKuliah')->get();

        return view('krs.data-krs', compact('krs'));
    }

    public function create()
    {
        $mahasiswa = Mahasiswa::all();
        $mataKuliah = MataKuliah::all();

        return view('krs.create-krs', compact('mahasiswa', 'mataKuliah'));
    }

    public function store(Request $request)
    {
        Krs::create($request->all());

        return redirect()->route('data-krs');
    }

    public function destroy($id)
    {
        Krs::find($id)->delete();

        return redirect()->route('data-krs');
    }

    public function edit($id)
    {
        $krs = Krs::find($id);

        $mahasiswa = Mahasiswa::all();
        $mataKuliah = MataKuliah::all();

        return view('krs.edit-krs', compact('krs', 'mahasiswa', 'mataKuliah'));
    }

    public function update(Request $request, $id)
    {
        $krs = Krs::find($id);

        $krs->update($request->all());

        return redirect()->route('data-krs');
    }
}