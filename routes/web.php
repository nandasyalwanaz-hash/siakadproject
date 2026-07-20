<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\JadwalKuliahController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\FuzzyHasilController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Halaman utama – bebas diakses tanpa login
Route::get('/', function () {
    return view('welcome-siakad', [
        'totalMahasiswa'  => \App\Models\Mahasiswa::count(),
        'totalDosen'      => \App\Models\Dosen::count(),
        'totalMataKuliah' => \App\Models\MataKuliah::count(),
    ]);
});

// MAHASISWA
Route::get('/data-mahasiswa', [MahasiswaController::class, 'index'])
    ->name('data-mahasiswa')
    ->middleware('hak_akses:Mahasiswa,view');

Route::get('/create-mahasiswa', [MahasiswaController::class, 'create'])
    ->name('create-mahasiswa')
    ->middleware('hak_akses:Mahasiswa,create');

Route::post('/data-mahasiswa', [MahasiswaController::class, 'store'])
    ->name('simpan-mahasiswa')
    ->middleware('hak_akses:Mahasiswa,create');

Route::post('store-mahasiswa', [MahasiswaController::class, 'store'])
    ->name('store-mahasiswa')
    ->middleware('hak_akses:Mahasiswa,create');

Route::get('/edit-mahasiswa/{id}', [MahasiswaController::class, 'edit'])
    ->name('edit-mahasiswa')
    ->middleware('hak_akses:Mahasiswa,edit');

Route::put('/update-mahasiswa/{id}', [MahasiswaController::class, 'update'])
    ->name('update-mahasiswa')
    ->middleware('hak_akses:Mahasiswa,edit');

Route::get('/hapus-mahasiswa/{id}', [MahasiswaController::class, 'destroy'])
    ->name('hapus-mahasiswa')
    ->middleware('hak_akses:Mahasiswa,delete');

// HAK AKSES  (hanya Admin)
Route::get('/hak-akses', [MahasiswaController::class, 'hakAkses'])
    ->name('hak-akses')
    ->middleware('hak_akses:HakAkses,view');

Route::get('/hak-akses/create', [MahasiswaController::class, 'hakAksesCreate'])
    ->name('create-hak-akses')
    ->middleware('hak_akses:HakAkses,create');

Route::post('/hak-akses', [MahasiswaController::class, 'hakAksesStore'])
    ->name('store-hak-akses')
    ->middleware('hak_akses:HakAkses,create');

Route::get('/hak-akses/{id}/edit', [MahasiswaController::class, 'hakAksesEdit'])
    ->name('edit-hak-akses')
    ->middleware('hak_akses:HakAkses,edit');

Route::put('/hak-akses/{id}', [MahasiswaController::class, 'hakAksesUpdate'])
    ->name('update-hak-akses')
    ->middleware('hak_akses:HakAkses,edit');

Route::delete('/hak-akses/{id}', [MahasiswaController::class, 'hakAksesDestroy'])
    ->name('delete-hak-akses')
    ->middleware('hak_akses:HakAkses,delete');

// DOSEN
Route::get('/data-dosen', [DosenController::class, 'index'])
    ->name('data-dosen')
    ->middleware('hak_akses:Dosen,view');

Route::get('/create-dosen', [DosenController::class, 'create'])
    ->middleware('hak_akses:Dosen,create');

Route::post('/store-dosen', [DosenController::class, 'store'])
    ->middleware('hak_akses:Dosen,create');

Route::get('/edit-dosen/{id}', [DosenController::class, 'edit'])
    ->middleware('hak_akses:Dosen,edit');

Route::put('/update-dosen/{id}', [DosenController::class, 'update'])
    ->middleware('hak_akses:Dosen,edit');

Route::get('/hapus-dosen/{id}', [DosenController::class, 'destroy'])
    ->middleware('hak_akses:Dosen,delete');

// MATA KULIAH
Route::get('/data-mata-kuliah', [MataKuliahController::class, 'index'])
    ->name('data-mata-kuliah')
    ->middleware('hak_akses:MataKuliah,view');

Route::get('/create-mata-kuliah', [MataKuliahController::class, 'create'])
    ->middleware('hak_akses:MataKuliah,create');

Route::post('/store-mata-kuliah', [MataKuliahController::class, 'store'])
    ->middleware('hak_akses:MataKuliah,create');

Route::get('/edit-mata-kuliah/{id}', [MataKuliahController::class, 'edit'])
    ->middleware('hak_akses:MataKuliah,edit');

Route::put('/update-mata-kuliah/{id}', [MataKuliahController::class, 'update'])
    ->middleware('hak_akses:MataKuliah,edit');

Route::get('/hapus-mata-kuliah/{id}', [MataKuliahController::class, 'destroy'])
    ->middleware('hak_akses:MataKuliah,delete');

// KRS
Route::get('/data-krs', [KrsController::class, 'index'])
    ->name('data-krs')
    ->middleware('hak_akses:KRS,view');

Route::get('/create-krs', [KrsController::class, 'create'])
    ->middleware('hak_akses:KRS,create');

Route::post('/store-krs', [KrsController::class, 'store'])
    ->middleware('hak_akses:KRS,create');

Route::get('/edit-krs/{id}', [KrsController::class, 'edit'])
    ->middleware('hak_akses:KRS,edit');

Route::put('/update-krs/{id}', [KrsController::class, 'update'])
    ->middleware('hak_akses:KRS,edit');

Route::get('/hapus-krs/{id}', [KrsController::class, 'destroy'])
    ->middleware('hak_akses:KRS,delete');

// ABSENSI
Route::get('/data-absensi', [AbsensiController::class, 'index'])
    ->name('data-absensi')
    ->middleware('hak_akses:Absensi,view');

Route::get('/create-absensi', [AbsensiController::class, 'create'])
    ->middleware('hak_akses:Absensi,create');

Route::post('/store-absensi', [AbsensiController::class, 'store'])
    ->middleware('hak_akses:Absensi,create');

Route::get('/edit-absensi/{id}', [AbsensiController::class, 'edit'])
    ->middleware('hak_akses:Absensi,edit');

Route::put('/update-absensi/{id}', [AbsensiController::class, 'update'])
    ->middleware('hak_akses:Absensi,edit');

Route::get('/hapus-absensi/{id}', [AbsensiController::class, 'destroy'])
    ->middleware('hak_akses:Absensi,delete');

// JADWAL KULIAH
Route::get('/data-jadwal', [JadwalKuliahController::class, 'index'])
    ->name('data-jadwal')
    ->middleware('hak_akses:JadwalKuliah,view');

Route::get('/create-jadwal', [JadwalKuliahController::class, 'create'])
    ->middleware('hak_akses:JadwalKuliah,create');

Route::post('/store-jadwal', [JadwalKuliahController::class, 'store'])
    ->middleware('hak_akses:JadwalKuliah,create');

Route::get('/edit-jadwal/{id}', [JadwalKuliahController::class, 'edit'])
    ->middleware('hak_akses:JadwalKuliah,edit');

Route::put('/update-jadwal/{id}', [JadwalKuliahController::class, 'update'])
    ->middleware('hak_akses:JadwalKuliah,edit');

Route::get('/hapus-jadwal/{id}', [JadwalKuliahController::class, 'destroy'])
    ->middleware('hak_akses:JadwalKuliah,delete');

// NILAI
Route::get('/data-nilai', [NilaiController::class, 'index'])
    ->name('data-nilai')
    ->middleware('hak_akses:Nilai,view');

Route::get('/create-nilai', [NilaiController::class, 'create'])
    ->middleware('hak_akses:Nilai,create');

Route::post('/store-nilai', [NilaiController::class, 'store'])
    ->middleware('hak_akses:Nilai,create');

Route::get('/edit-nilai/{id}', [NilaiController::class, 'edit'])
    ->middleware('hak_akses:Nilai,edit');

Route::put('/update-nilai/{id}', [NilaiController::class, 'update'])
    ->middleware('hak_akses:Nilai,edit');

Route::get('/hapus-nilai/{id}', [NilaiController::class, 'destroy'])
    ->middleware('hak_akses:Nilai,delete');

// FUZZY LOGIC — Evaluasi/Prediksi Kelulusan Mata Kuliah (Mamdani)
Route::get('/data-fuzzy-hasil', [FuzzyHasilController::class, 'index'])
    ->name('data-fuzzy-hasil')
    ->middleware('hak_akses:FuzzyHasil,view');

Route::get('/create-fuzzy-hasil/{krsId}', [FuzzyHasilController::class, 'create'])
    ->name('create-fuzzy-hasil')
    ->middleware('hak_akses:FuzzyHasil,create');

Route::post('/store-fuzzy-hasil', [FuzzyHasilController::class, 'store'])
    ->name('store-fuzzy-hasil')
    ->middleware('hak_akses:FuzzyHasil,create');

Route::get('/hasil-fuzzy/{id}', [FuzzyHasilController::class, 'show'])
    ->name('show-fuzzy-hasil')
    ->middleware('hak_akses:FuzzyHasil,view');

Route::get('/hapus-fuzzy-hasil/{id}', [FuzzyHasilController::class, 'destroy'])
    ->name('hapus-fuzzy-hasil')
    ->middleware('hak_akses:FuzzyHasil,delete');

// AUTHENTIKASI
Route::get('/login', function () {
    return redirect('/');
})->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// ROUTE DASHBOARD (ganti redirect lama di AuthController)
Route::get('/dashboard', [DashboardController::class, 'index']) ->name('dashboard') ->middleware('auth'); 