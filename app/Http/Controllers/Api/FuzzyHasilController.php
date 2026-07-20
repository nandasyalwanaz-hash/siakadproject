<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreFuzzyHasilRequest;
use App\Http\Requests\Api\UpdateFuzzyHasilRequest;
use App\Http\Resources\FuzzyHasilResource;
use App\Models\FuzzyHasil;
use App\Services\FuzzyMamdaniService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FuzzyHasilController extends Controller
{
    protected FuzzyMamdaniService $fuzzy;

    public function __construct(FuzzyMamdaniService $fuzzy)
    {
        $this->fuzzy = $fuzzy;
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        $hasil = FuzzyHasil::with('krs.mahasiswa', 'krs.mataKuliah')
            ->when($request->krs_id, fn ($q) => $q->where('krs_id', $request->krs_id))
            ->when($request->kategori, fn ($q) => $q->where('kategori', $request->kategori))
            ->orderByDesc('created_at')
            ->paginate($request->get('per_page', 15));

        return FuzzyHasilResource::collection($hasil);
    }

    public function store(StoreFuzzyHasilRequest $request): JsonResponse
    {
        $hasil = $this->fuzzy->hitung(
            (float) $request->kehadiran,
            (float) $request->nilai_tugas,
            (float) $request->keaktifan_diskusi
        );

        $fuzzyHasil = FuzzyHasil::updateOrCreate(
            ['krs_id' => $request->krs_id],
            [
                'kehadiran'           => $request->kehadiran,
                'nilai_tugas'         => $request->nilai_tugas,
                'keaktifan_diskusi'   => $request->keaktifan_diskusi,
                'hasil_defuzzifikasi' => $hasil['skor'],
                'kategori'            => $hasil['kategori'],
            ]
        );

        return response()->json([
            'message' => 'Hasil fuzzy berhasil disimpan.',
            'data'    => new FuzzyHasilResource($fuzzyHasil->load('krs')),
        ], 201);
    }

    public function show(FuzzyHasil $fuzzy_hasil): FuzzyHasilResource
    {
        $fuzzy_hasil->load('krs.mahasiswa', 'krs.mataKuliah');

        return new FuzzyHasilResource($fuzzy_hasil);
    }

    public function update(UpdateFuzzyHasilRequest $request, FuzzyHasil $fuzzy_hasil): JsonResponse
    {
        $hasil = $this->fuzzy->hitung(
            (float) $request->kehadiran,
            (float) $request->nilai_tugas,
            (float) $request->keaktifan_diskusi
        );

        $fuzzy_hasil->update([
            'kehadiran'           => $request->kehadiran,
            'nilai_tugas'         => $request->nilai_tugas,
            'keaktifan_diskusi'   => $request->keaktifan_diskusi,
            'hasil_defuzzifikasi' => $hasil['skor'],
            'kategori'            => $hasil['kategori'],
        ]);

        return response()->json([
            'message' => 'Hasil fuzzy berhasil diperbarui.',
            'data'    => new FuzzyHasilResource($fuzzy_hasil->load('krs')),
        ]);
    }

    public function destroy(FuzzyHasil $fuzzy_hasil): JsonResponse
    {
        $fuzzy_hasil->delete();

        return response()->json([
            'message' => 'Hasil fuzzy berhasil dihapus.',
        ]);
    }
}
