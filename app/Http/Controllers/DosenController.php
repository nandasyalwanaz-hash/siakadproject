<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;

class DosenController extends Controller
{
    public function index()
    {
        $dosen = Dosen::all();

        return view('dosen.data-dosen', compact('dosen'));
    }

    public function create()
    {
        return view('dosen.create-dosen');
    }

    public function store(Request $request)
    {
        Dosen::create($request->all());

        return redirect()->route('data-dosen');
    }

    public function destroy($id)
    {
        Dosen::find($id)->delete();

        return redirect()->route('data-dosen');
    }

    public function edit($id)
    {
        $dosen = Dosen::find($id);

        return view('dosen.edit-dosen', compact('dosen'));
    }

    public function update(Request $request, $id)
    {
        $dosen = Dosen::find($id);

        $dosen->update($request->all());

        return redirect()->route('data-dosen');
    }
}