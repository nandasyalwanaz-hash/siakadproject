<?php

use App\Http\Controllers\Api\AbsensiController;
use App\Http\Controllers\Api\DosenController;
use App\Http\Controllers\Api\FuzzyHasilController;
use App\Http\Controllers\Api\HakAksesController;
use App\Http\Controllers\Api\JadwalKuliahController;
use App\Http\Controllers\Api\KrsController;
use App\Http\Controllers\Api\MahasiswaController;
use App\Http\Controllers\Api\MataKuliahController;
use App\Http\Controllers\Api\NilaiController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    // Dosen
    Route::apiResource('dosen', DosenController::class);

    // Mata Kuliah
    Route::apiResource('mata-kuliah', MataKuliahController::class);

    // Mahasiswa
    Route::apiResource('mahasiswa', MahasiswaController::class);

    // KRS
    Route::apiResource('krs', KrsController::class);

    // Absensi
    Route::apiResource('absensi', AbsensiController::class);

    // Jadwal Kuliah
    Route::apiResource('jadwal-kuliah', JadwalKuliahController::class);

    // Nilai
    Route::apiResource('nilai', NilaiController::class);

    // Fuzzy Hasil
    Route::apiResource('fuzzy-hasil', FuzzyHasilController::class);

    // Hak Akses
    Route::apiResource('hak-akses', HakAksesController::class);
});
