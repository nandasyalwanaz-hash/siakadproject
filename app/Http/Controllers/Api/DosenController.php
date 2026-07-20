<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreDosenRequest;
use App\Http\Requests\Api\UpdateDosenRequest;
use App\Http\Resources\DosenResource;
use App\Models\Dosen;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DosenController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $dosen = Dosen::with('mataKuliah')
            ->when($request->search, fn ($q) => $q->where('nama_dosen', 'like', "%{$request->search}%")
                ->orWhere('nidn', 'like', "%{$request->search}%"))
            ->orderBy('nama_dosen')
            ->paginate($request->get('per_page', 15));

        return DosenResource::collection($dosen);
    }

    public function store(StoreDosenRequest $request): JsonResponse
    {
        $dosen = Dosen::create($request->validated());

        return response()->json([
            'message' => 'Dosen berhasil ditambahkan.',
            'data'    => new DosenResource($dosen),
        ], 201);
    }

    public function show(Dosen $dosen): DosenResource
    {
        $dosen->load('mataKuliah', 'jadwalKuliah');

        return new DosenResource($dosen);
    }

    public function update(UpdateDosenRequest $request, Dosen $dosen): JsonResponse
    {
        $dosen->update($request->validated());

        return response()->json([
            'message' => 'Dosen berhasil diperbarui.',
            'data'    => new DosenResource($dosen),
        ]);
    }

    public function destroy(Dosen $dosen): JsonResponse
    {
        $dosen->delete();

        return response()->json([
            'message' => 'Dosen berhasil dihapus.',
        ]);
    }
}
