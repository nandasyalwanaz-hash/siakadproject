<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreAbsensiRequest;
use App\Http\Requests\Api\UpdateAbsensiRequest;
use App\Http\Resources\AbsensiResource;
use App\Models\Absensi;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AbsensiController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $absensi = Absensi::with('mahasiswa', 'mataKuliah')
            ->when($request->mahasiswa_id, fn ($q) => $q->where('mahasiswa_id', $request->mahasiswa_id))
            ->when($request->mata_kuliah_id, fn ($q) => $q->where('mata_kuliah_id', $request->mata_kuliah_id))
            ->when($request->status, fn ($q) => $q->where('status', $request->status))
            ->when($request->tanggal, fn ($q) => $q->whereDate('tanggal', $request->tanggal))
            ->orderByDesc('tanggal')
            ->paginate($request->get('per_page', 15));

        return AbsensiResource::collection($absensi);
    }

    public function store(StoreAbsensiRequest $request): JsonResponse
    {
        $absensi = Absensi::create($request->validated());

        return response()->json([
            'message' => 'Absensi berhasil ditambahkan.',
            'data'    => new AbsensiResource($absensi->load('mahasiswa', 'mataKuliah')),
        ], 201);
    }

    public function show(Absensi $absensi): AbsensiResource
    {
        $absensi->load('mahasiswa', 'mataKuliah');

        return new AbsensiResource($absensi);
    }

    public function update(UpdateAbsensiRequest $request, Absensi $absensi): JsonResponse
    {
        $absensi->update($request->validated());

        return response()->json([
            'message' => 'Absensi berhasil diperbarui.',
            'data'    => new AbsensiResource($absensi->load('mahasiswa', 'mataKuliah')),
        ]);
    }

    public function destroy(Absensi $absensi): JsonResponse
    {
        $absensi->delete();

        return response()->json([
            'message' => 'Absensi berhasil dihapus.',
        ]);
    }
}
