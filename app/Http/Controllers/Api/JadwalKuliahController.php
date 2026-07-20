<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreJadwalKuliahRequest;
use App\Http\Requests\Api\UpdateJadwalKuliahRequest;
use App\Http\Resources\JadwalKuliahResource;
use App\Models\JadwalKuliah;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class JadwalKuliahController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $jadwal = JadwalKuliah::with('mataKuliah', 'dosen')
            ->when($request->hari, fn ($q) => $q->where('hari', $request->hari))
            ->when($request->dosen_id, fn ($q) => $q->where('dosen_id', $request->dosen_id))
            ->when($request->mata_kuliah_id, fn ($q) => $q->where('mata_kuliah_id', $request->mata_kuliah_id))
            ->orderBy('hari')
            ->orderBy('jam_mulai')
            ->paginate($request->get('per_page', 15));

        return JadwalKuliahResource::collection($jadwal);
    }

    public function store(StoreJadwalKuliahRequest $request): JsonResponse
    {
        $jadwal = JadwalKuliah::create($request->validated());

        return response()->json([
            'message' => 'Jadwal kuliah berhasil ditambahkan.',
            'data'    => new JadwalKuliahResource($jadwal->load('mataKuliah', 'dosen')),
        ], 201);
    }

    public function show(JadwalKuliah $jadwal_kuliah): JadwalKuliahResource
    {
        $jadwal_kuliah->load('mataKuliah', 'dosen');

        return new JadwalKuliahResource($jadwal_kuliah);
    }

    public function update(UpdateJadwalKuliahRequest $request, JadwalKuliah $jadwal_kuliah): JsonResponse
    {
        $jadwal_kuliah->update($request->validated());

        return response()->json([
            'message' => 'Jadwal kuliah berhasil diperbarui.',
            'data'    => new JadwalKuliahResource($jadwal_kuliah->load('mataKuliah', 'dosen')),
        ]);
    }

    public function destroy(JadwalKuliah $jadwal_kuliah): JsonResponse
    {
        $jadwal_kuliah->delete();

        return response()->json([
            'message' => 'Jadwal kuliah berhasil dihapus.',
        ]);
    }
}
