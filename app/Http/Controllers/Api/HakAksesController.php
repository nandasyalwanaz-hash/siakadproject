<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreHakAksesRequest;
use App\Http\Requests\Api\UpdateHakAksesRequest;
use App\Http\Resources\HakAksesResource;
use App\Models\HakAkses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HakAksesController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $hakAkses = HakAkses::with('users')
            ->when($request->search, fn ($q) => $q->where('role', 'like', "%{$request->search}%")
                ->orWhere('modul', 'like', "%{$request->search}%"))
            ->orderBy('role')
            ->paginate($request->get('per_page', 15));

        return HakAksesResource::collection($hakAkses);
    }

    public function store(StoreHakAksesRequest $request): JsonResponse
    {
        $hakAkses = HakAkses::create($request->validated());

        return response()->json([
            'message' => 'Hak akses berhasil ditambahkan.',
            'data'    => new HakAksesResource($hakAkses),
        ], 201);
    }

    public function show(HakAkses $hak_akses): HakAksesResource
    {
        $hak_akses->load('users');

        return new HakAksesResource($hak_akses);
    }

    public function update(UpdateHakAksesRequest $request, HakAkses $hak_akses): JsonResponse
    {
        $hak_akses->update($request->validated());

        return response()->json([
            'message' => 'Hak akses berhasil diperbarui.',
            'data'    => new HakAksesResource($hak_akses),
        ]);
    }

    public function destroy(HakAkses $hak_akses): JsonResponse
    {
        $hak_akses->delete();

        return response()->json([
            'message' => 'Hak akses berhasil dihapus.',
        ]);
    }
}
