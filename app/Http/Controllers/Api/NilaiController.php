<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreNilaiRequest;
use App\Http\Requests\Api\UpdateNilaiRequest;
use App\Http\Resources\NilaiResource;
use App\Models\Nilai;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NilaiController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $nilai = Nilai::with('krs.mahasiswa', 'krs.mataKuliah')
            ->when($request->krs_id, fn ($q) => $q->where('krs_id', $request->krs_id))
            ->orderByDesc('created_at')
            ->paginate($request->get('per_page', 15));

        return NilaiResource::collection($nilai);
    }

    public function store(StoreNilaiRequest $request): JsonResponse
    {
        $data = $request->validated();

        if ($data['nilai_tugas'] && $data['nilai_uts'] && $data['nilai_uas']) {
            $akhir = ($data['nilai_tugas'] * 0.3)
                   + ($data['nilai_uts'] * 0.3)
                   + ($data['nilai_uas'] * 0.4);

            $data['nilai_akhir'] = round($akhir, 2);
            $data['grade'] = $this->hitungGrade($akhir);
        }

        $nilai = Nilai::create($data);

        return response()->json([
            'message' => 'Nilai berhasil ditambahkan.',
            'data'    => new NilaiResource($nilai->load('krs')),
        ], 201);
    }

    public function show(Nilai $nilai): NilaiResource
    {
        $nilai->load('krs.mahasiswa', 'krs.mataKuliah');

        return new NilaiResource($nilai);
    }

    public function update(UpdateNilaiRequest $request, Nilai $nilai): JsonResponse
    {
        $data = $request->validated();

        if ($data['nilai_tugas'] && $data['nilai_uts'] && $data['nilai_uas']) {
            $akhir = ($data['nilai_tugas'] * 0.3)
                   + ($data['nilai_uts'] * 0.3)
                   + ($data['nilai_uas'] * 0.4);

            $data['nilai_akhir'] = round($akhir, 2);
            $data['grade'] = $this->hitungGrade($akhir);
        }

        $nilai->update($data);

        return response()->json([
            'message' => 'Nilai berhasil diperbarui.',
            'data'    => new NilaiResource($nilai->load('krs')),
        ]);
    }

    public function destroy(Nilai $nilai): JsonResponse
    {
        $nilai->delete();

        return response()->json([
            'message' => 'Nilai berhasil dihapus.',
        ]);
    }

    private function hitungGrade($nilai): string
    {
        if ($nilai >= 85) return 'A';
        if ($nilai >= 80) return 'A-';
        if ($nilai >= 75) return 'B+';
        if ($nilai >= 70) return 'B';
        if ($nilai >= 65) return 'B-';
        if ($nilai >= 60) return 'C+';
        if ($nilai >= 55) return 'C';
        if ($nilai >= 40) return 'D';
        return 'E';
    }
}
