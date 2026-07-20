<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreMataKuliahRequest;
use App\Http\Requests\Api\UpdateMataKuliahRequest;
use App\Http\Resources\MataKuliahResource;
use App\Models\MataKuliah;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MataKuliahController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $mataKuliah = MataKuliah::with('dosen')
            ->when($request->search, fn ($q) => $q->where('nama_mk', 'like', "%{$request->search}%")
                ->orWhere('kode_mk', 'like', "%{$request->search}%"))
            ->orderBy('kode_mk')
            ->paginate($request->get('per_page', 15));

        return MataKuliahResource::collection($mataKuliah);
    }

    public function store(StoreMataKuliahRequest $request): JsonResponse
    {
        $mataKuliah = MataKuliah::create($request->validated());

        return response()->json([
            'message' => 'Mata kuliah berhasil ditambahkan.',
            'data'    => new MataKuliahResource($mataKuliah->load('dosen')),
        ], 201);
    }

    public function show(MataKuliah $mata_kuliah): MataKuliahResource
    {
        $mata_kuliah->load('dosen', 'krs.mahasiswa', 'jadwalKuliah.dosen');

        return new MataKuliahResource($mata_kuliah);
    }

    public function update(UpdateMataKuliahRequest $request, MataKuliah $mata_kuliah): JsonResponse
    {
        $mata_kuliah->update($request->validated());

        return response()->json([
            'message' => 'Mata kuliah berhasil diperbarui.',
            'data'    => new MataKuliahResource($mata_kuliah->load('dosen')),
        ]);
    }

    public function destroy(MataKuliah $mata_kuliah): JsonResponse
    {
        $mata_kuliah->delete();

        return response()->json([
            'message' => 'Mata kuliah berhasil dihapus.',
        ]);
    }
}
