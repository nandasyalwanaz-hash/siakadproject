<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreMahasiswaRequest;
use App\Http\Requests\Api\UpdateMahasiswaRequest;
use App\Http\Resources\MahasiswaResource;
use App\Models\Mahasiswa;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MahasiswaController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $mahasiswa = Mahasiswa::with('krs')
            ->when($request->search, fn ($q) => $q->where('nama', 'like', "%{$request->search}%")
                ->orWhere('nim', 'like', "%{$request->search}%"))
            ->orderBy('nim')
            ->paginate($request->get('per_page', 15));

        return MahasiswaResource::collection($mahasiswa);
    }

    public function store(StoreMahasiswaRequest $request): JsonResponse
    {
        $mahasiswa = Mahasiswa::create($request->validated());

        return response()->json([
            'message' => 'Mahasiswa berhasil ditambahkan.',
            'data'    => new MahasiswaResource($mahasiswa),
        ], 201);
    }

    public function show(Mahasiswa $mahasiswa): MahasiswaResource
    {
        $mahasiswa->load('krs.mataKuliah', 'absensi.mataKuliah');

        return new MahasiswaResource($mahasiswa);
    }

    public function update(UpdateMahasiswaRequest $request, Mahasiswa $mahasiswa): JsonResponse
    {
        $mahasiswa->update($request->validated());

        return response()->json([
            'message' => 'Mahasiswa berhasil diperbarui.',
            'data'    => new MahasiswaResource($mahasiswa),
        ]);
    }

    public function destroy(Mahasiswa $mahasiswa): JsonResponse
    {
        $mahasiswa->delete();

        return response()->json([
            'message' => 'Mahasiswa berhasil dihapus.',
        ]);
    }
}
