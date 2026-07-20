@extends('layouts.app')

@section('content')

{{-- Greeting --}}
<div class="d-flex align-items-center justify-content-between mb-4">
  <div>
    <h4 class="mb-0 fw-semibold" style="color:#2c3a54">
      Dashboard Operator 🔐
    </h4>
    <small class="text-muted">{{ now()->isoFormat('dddd, D MMMM Y') }} · Manajemen Sistem</small>
  </div>
</div>

{{-- Info Card --}}
<div class="row g-3 mb-4">
  <div class="col-12">
    <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #2c3a54 0%, #3d5075 100%);">
      <div class="card-body d-flex align-items-center gap-4 py-4">
        <div class="rounded-circle d-flex align-items-center justify-content-center"
             style="width:64px;height:64px;min-width:64px;background:rgba(71,178,228,.2)">
          <i class="bi bi-shield-lock-fill" style="color:#47b2e4;font-size:1.8rem"></i>
        </div>
        <div>
          <div class="fw-bold text-white fs-5">{{ auth()->user()->name }}</div>
          <div style="color:rgba(255,255,255,.65);font-size:.875rem">
            Anda login sebagai <span class="badge" style="background:#47b2e4">Operator</span>
          </div>
          <div class="mt-1" style="color:rgba(255,255,255,.5);font-size:.8rem">
            Tugas utama: mengatur hak akses setiap role terhadap modul sistem
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@php
  $totalHakAkses = \App\Models\HakAkses::count();
  $roles = \App\Models\HakAkses::select('role')->distinct()->pluck('role');
  $moduls = \App\Models\HakAkses::select('modul')->distinct()->pluck('modul');
@endphp

<div class="row g-3 mb-4">
  <div class="col-6 col-lg-4">
    <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #47b2e4 !important">
      <div class="card-body">
        <div class="d-flex align-items-center gap-3">
          <div class="rounded-circle d-flex align-items-center justify-content-center"
               style="width:48px;height:48px;background:rgba(71,178,228,.15)">
            <i class="bi bi-shield-fill-check" style="color:#47b2e4;font-size:1.3rem"></i>
          </div>
          <div>
            <div class="fs-2 fw-bold" style="color:#2c3a54">{{ $totalHakAkses }}</div>
            <div class="text-muted small">Total Aturan Akses</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-6 col-lg-4">
    <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #5dd68c !important">
      <div class="card-body">
        <div class="d-flex align-items-center gap-3">
          <div class="rounded-circle d-flex align-items-center justify-content-center"
               style="width:48px;height:48px;background:rgba(93,214,140,.15)">
            <i class="bi bi-person-fill-gear" style="color:#5dd68c;font-size:1.3rem"></i>
          </div>
          <div>
            <div class="fs-2 fw-bold" style="color:#2c3a54">{{ $roles->count() }}</div>
            <div class="text-muted small">Role Terdaftar</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-6 col-lg-4">
    <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #ffc107 !important">
      <div class="card-body">
        <div class="d-flex align-items-center gap-3">
          <div class="rounded-circle d-flex align-items-center justify-content-center"
               style="width:48px;height:48px;background:rgba(255,193,7,.15)">
            <i class="bi bi-grid-3x3-gap-fill" style="color:#ffc107;font-size:1.3rem"></i>
          </div>
          <div>
            <div class="fs-2 fw-bold" style="color:#2c3a54">{{ $moduls->count() }}</div>
            <div class="text-muted small">Modul Sistem</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row g-3">
  <div class="col-12">
    <div class="card border-0 shadow-sm">
      <div class="card-header bg-white border-0 d-flex align-items-center gap-2 pt-3">
        <i class="bi bi-table" style="color:#47b2e4"></i>
        <span class="fw-semibold">Ringkasan Hak Akses</span>
        <a href="{{ url('/hak-akses') }}" class="btn btn-sm btn-primary ms-auto" style="font-size:.75rem">
          <i class="bi bi-pencil-fill me-1"></i> Kelola
        </a>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-sm table-hover mb-0">
            <thead style="background:#f8f9fa">
              <tr>
                <th class="px-3 py-2">Role</th>
                <th class="px-3 py-2">Modul</th>
                <th class="text-center py-2">Lihat</th>
                <th class="text-center py-2">Tambah</th>
                <th class="text-center py-2">Edit</th>
                <th class="text-center py-2">Hapus</th>
              </tr>
            </thead>
            <tbody>
              @foreach(\App\Models\HakAkses::orderBy('role')->orderBy('modul')->get() as $ha)
              @php
                $roleColors = ['Admin'=>'danger','Mahasiswa'=>'success','Dosen'=>'warning','Operator'=>'info'];
                $color = $roleColors[$ha->role] ?? 'secondary';
              @endphp
              <tr>
                <td class="px-3 py-2"><span class="badge bg-{{ $color }}">{{ $ha->role }}</span></td>
                <td class="px-3 py-2 fw-semibold" style="font-size:.875rem">{{ $ha->modul }}</td>
                <td class="text-center py-2">
                  @if($ha->can_view) <i class="bi bi-check-circle-fill text-success"></i>
                  @else <i class="bi bi-x-circle-fill text-danger"></i> @endif
                </td>
                <td class="text-center py-2">
                  @if($ha->can_create) <i class="bi bi-check-circle-fill text-success"></i>
                  @else <i class="bi bi-x-circle-fill text-danger"></i> @endif
                </td>
                <td class="text-center py-2">
                  @if($ha->can_edit) <i class="bi bi-check-circle-fill text-success"></i>
                  @else <i class="bi bi-x-circle-fill text-danger"></i> @endif
                </td>
                <td class="text-center py-2">
                  @if($ha->can_delete) <i class="bi bi-check-circle-fill text-success"></i>
                  @else <i class="bi bi-x-circle-fill text-danger"></i> @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection