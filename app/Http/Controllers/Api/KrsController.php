<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreKrsRequest;
use App\Http\Requests\Api\UpdateKrsRequest;
use App\Http\Resources\KrsResource;
use App\Models\Krs;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class KrsController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $krs = Krs::with('mahasiswa', 'mataKuliah')
            ->when($request->mahasiswa_id, fn ($q) => $q->where('mahasiswa_id', $request->mahasiswa_id))
            ->when($request->mata_kuliah_id, fn ($q) => $q->where('mata_kuliah_id', $request->mata_kuliah_id))
            ->when($request->semester, fn ($q) => $q->where('semester', $request->semester))
            ->orderByDesc('created_at')
            ->paginate($request->get('per_page', 15));

        return KrsResource::collection($krs);
    }

    public function store(StoreKrsRequest $request): JsonResponse
    {
        $krs = Krs::create($request->validated());

        return response()->json([
            'message' => 'KRS berhasil ditambahkan.',
            'data'    => new KrsResource($krs->load('mahasiswa', 'mataKuliah')),
        ], 201);
    }

    public function show(Krs $krs): KrsResource
    {
        $krs->load('mahasiswa', 'mataKuliah.dosen', 'dataNilai', 'fuzzyHasil');

        return new KrsResource($krs);
    }

    public function update(UpdateKrsRequest $request, Krs $krs): JsonResponse
    {
        $krs->update($request->validated());

        return response()->json([
            'message' => 'KRS berhasil diperbarui.',
            'data'    => new KrsResource($krs->load('mahasiswa', 'mataKuliah')),
        ]);
    }

    public function destroy(Krs $krs): JsonResponse
    {
        $krs->delete();

        return response()->json([
            'message' => 'KRS berhasil dihapus.',
        ]);
    }
}
