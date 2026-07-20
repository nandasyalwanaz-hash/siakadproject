<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;
use App\Models\Dosen;

class MataKuliahController extends Controller
{
    public function index()
    {
        $mataKuliah = MataKuliah::with('dosen')->get();

        return view('mata_kuliah.data-mata-kuliah', compact('mataKuliah'));
    }

    public function create()
    {
        $dosen = Dosen::all();

        return view('mata_kuliah.create-mata-kuliah', compact('dosen'));
    }

    public function store(Request $request)
    {
        MataKuliah::create($request->all());

        return redirect()->route('data-mata-kuliah');
    }

    public function destroy($id)
    {
        MataKuliah::find($id)->delete();

        return redirect()->route('data-mata-kuliah');
    }

    public function edit($id)
    {
        $mataKuliah = MataKuliah::find($id);
        $dosen = Dosen::all();

        return view('mata_kuliah.edit-mata-kuliah', compact('mataKuliah', 'dosen'));
    }

    public function update(Request $request, $id)
    {
        $mataKuliah = MataKuliah::find($id);

        $mataKuliah->update($request->all());

        return redirect()->route('data-mata-kuliah');
    }
}