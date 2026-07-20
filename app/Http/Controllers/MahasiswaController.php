<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\HakAkses; // hak akses

class MahasiswaController extends Controller
{
    // TAMPILKAN DATA KE TABEL
    public function index()
    {
        $mahasiswa = Mahasiswa::orderBy('nim')->get();

        return view('data-mahasiswa', compact('mahasiswa'));
    }

    // HALAMAN FORM TAMBAH DATA
    public function create()
    {
        return view('create-mahasiswa');
    }

    // SIMPAN DATA DARI FORM
public function store(Request $request)
{
    Mahasiswa::create($request->all());

    return redirect()->route('data-mahasiswa');
}

    // DELETE DATA
    public function destroy($id)
    {
        Mahasiswa::find($id)->delete();

        return redirect()->route('data-mahasiswa');
    }

    // HALAMAN FORM EDIT
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::find($id);

        return view('edit-mahasiswa', compact('mahasiswa'));
    }

    // UPDATE DATA
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::find($id);

        $mahasiswa->update($request->all());

        return redirect()->route('data-mahasiswa');
    }

    //hak akses
    public function hakAkses()
{
    $hakAkses = HakAkses::paginate(10);

    return view('hak_akses.hak-akses', compact('hakAkses'));
}

public function hakAksesCreate()
{
    return view('hak_akses.create');
}

public function hakAksesStore(Request $request)
{
    HakAkses::create([
        'role' => $request->role,
        'modul' => $request->modul,
        'can_view' => $request->can_view ? 1 : 0,
        'can_create' => $request->can_create ? 1 : 0,
        'can_edit' => $request->can_edit ? 1 : 0,
        'can_delete' => $request->can_delete ? 1 : 0,
    ]);

    return redirect()->route('hak-akses');
}

public function hakAksesEdit($id)
{
    $hakAkses = HakAkses::findOrFail($id);

    return view('hak_akses.edit', compact('hakAkses'));
}

public function hakAksesUpdate(Request $request, $id)
{
    $hakAkses = HakAkses::findOrFail($id);

    $hakAkses->update($request->all());

    return redirect()->route('hak-akses');
}

public function hakAksesDestroy($id)
{
    HakAkses::destroy($id);

    return redirect()->route('hak-akses');
}
}