@extends('layouts.app')

@section('content')

{{-- ── Greeting ── --}}
<div class="d-flex align-items-center justify-content-between mb-4">
  <div>
    <h4 class="mb-0 fw-semibold" style="color:#2c3a54">
      Dashboard Administrator 🎛️
    </h4>
    <small class="text-muted">{{ now()->isoFormat('dddd, D MMMM Y') }} · Sistem Informasi Akademik</small>
  </div>
</div>

{{-- ── Stat Cards ── --}}
<div class="row g-3 mb-4">

  <div class="col-6 col-lg-3">
    <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #47b2e4 !important">
      <div class="card-body">
        <div class="d-flex align-items-center gap-3">
          <div class="rounded-circle d-flex align-items-center justify-content-center"
               style="width:48px;height:48px;background:rgba(71,178,228,.15)">
            <i class="bi bi-people-fill" style="color:#47b2e4;font-size:1.3rem"></i>
          </div>
          <div>
            <div class="fs-2 fw-bold" style="color:#2c3a54">{{ $stats['total_mahasiswa'] }}</div>
            <div class="text-muted small">Total Mahasiswa</div>
          </div>
        </div>
        <a href="{{ url('/data-mahasiswa') }}" class="btn btn-link btn-sm p-0 mt-2 text-decoration-none">
          Kelola &rarr;
        </a>
      </div>
    </div>
  </div>

  <div class="col-6 col-lg-3">
    <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #ffc107 !important">
      <div class="card-body">
        <div class="d-flex align-items-center gap-3">
          <div class="rounded-circle d-flex align-items-center justify-content-center"
               style="width:48px;height:48px;background:rgba(255,193,7,.15)">
            <i class="bi bi-person-badge-fill" style="color:#ffc107;font-size:1.3rem"></i>
          </div>
          <div>
            <div class="fs-2 fw-bold" style="color:#2c3a54">{{ $stats['total_dosen'] }}</div>
            <div class="text-muted small">Total Dosen</div>
          </div>
        </div>
        <a href="{{ url('/data-dosen') }}" class="btn btn-link btn-sm p-0 mt-2 text-decoration-none">
          Kelola &rarr;
        </a>
      </div>
    </div>
  </div>

  <div class="col-6 col-lg-3">
    <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #5dd68c !important">
      <div class="card-body">
        <div class="d-flex align-items-center gap-3">
          <div class="rounded-circle d-flex align-items-center justify-content-center"
               style="width:48px;height:48px;background:rgba(93,214,140,.15)">
            <i class="bi bi-journal-bookmark-fill" style="color:#5dd68c;font-size:1.3rem"></i>
          </div>
          <div>
            <div class="fs-2 fw-bold" style="color:#2c3a54">{{ $stats['total_matkul'] }}</div>
            <div class="text-muted small">Mata Kuliah</div>
          </div>
        </div>
        <a href="{{ url('/data-mata-kuliah') }}" class="btn btn-link btn-sm p-0 mt-2 text-decoration-none">
          Kelola &rarr;
        </a>
      </div>
    </div>
  </div>

  <div class="col-6 col-lg-3">
    <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #a78bfa !important">
      <div class="card-body">
        <div class="d-flex align-items-center gap-3">
          <div class="rounded-circle d-flex align-items-center justify-content-center"
               style="width:48px;height:48px;background:rgba(167,139,250,.15)">
            <i class="bi bi-card-list" style="color:#a78bfa;font-size:1.3rem"></i>
          </div>
          <div>
            <div class="fs-2 fw-bold" style="color:#2c3a54">{{ $stats['total_krs'] }}</div>
            <div class="text-muted small">Total KRS</div>
          </div>
        </div>
        <a href="{{ url('/data-krs') }}" class="btn btn-link btn-sm p-0 mt-2 text-decoration-none">
          Kelola &rarr;
        </a>
      </div>
    </div>
  </div>

</div>

<div class="row g-3">

  {{-- Mahasiswa Terbaru --}}
  <div class="col-md-6">
    <div class="card border-0 shadow-sm h-100">
      <div class="card-header bg-white border-0 d-flex align-items-center gap-2 pt-3">
        <i class="bi bi-person-plus-fill" style="color:#47b2e4"></i>
        <span class="fw-semibold">Mahasiswa Terbaru</span>
        <a href="{{ url('/data-mahasiswa') }}" class="btn btn-sm btn-outline-primary ms-auto" style="font-size:.75rem">
          Lihat Semua
        </a>
      </div>
      <div class="card-body p-0">
        @forelse($mahasiswaBaru as $mhs)
          <div class="d-flex align-items-center px-3 py-2 border-bottom border-light gap-3">
            <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold"
                 style="width:36px;height:36px;min-width:36px;background:rgba(71,178,228,.15);color:#47b2e4;font-size:.8rem">
              {{ strtoupper(substr($mhs->nama, 0, 1)) }}
            </div>
            <div class="flex-grow-1">
              <div class="fw-semibold" style="font-size:.875rem">{{ $mhs->nama }}</div>
              <div class="small text-muted">{{ $mhs->nim }} · {{ $mhs->prodi }}</div>
            </div>
            <small class="text-muted">Sem {{ $mhs->semester }}</small>
          </div>
        @empty
          <div class="text-center py-4 text-muted">Belum ada data mahasiswa</div>
        @endforelse
      </div>
    </div>
  </div>

  {{-- Panel Navigasi Admin --}}
  <div class="col-md-6">
    <div class="row g-3 h-100">

      {{-- Absensi Hari Ini --}}
      <div class="col-12">
        <div class="card border-0 shadow-sm"
             style="background: linear-gradient(135deg, #2c3a54 0%, #3d5075 100%)">
          <div class="card-body d-flex align-items-center gap-3">
            <div>
              <div class="fs-1 fw-bold text-white">{{ $absensiHariIni }}</div>
              <div style="color:rgba(255,255,255,.7);font-size:.875rem">Record Absensi Hari Ini</div>
            </div>
            <i class="bi bi-clipboard2-check-fill ms-auto"
               style="font-size:3rem;color:rgba(71,178,228,.4)"></i>
          </div>
        </div>
      </div>

      {{-- Distribusi Nilai --}}
      <div class="col-12">
        <div class="card border-0 shadow-sm">
          <div class="card-header bg-white border-0 pt-3">
            <span class="fw-semibold"><i class="bi bi-bar-chart-fill text-warning me-1"></i> Distribusi Nilai</span>
          </div>
          <div class="card-body pt-0">
            @php
              $grades = ['A' => '#5dd68c', 'B' => '#47b2e4', 'C' => '#ffc107', 'D' => '#fd7e14', 'E' => '#f77'];
              $total  = $distribusiNilai->sum() ?: 1;
            @endphp
            @foreach($grades as $grade => $color)
              @php $val = $distribusiNilai->get($grade, 0); @endphp
              <div class="d-flex align-items-center gap-2 mb-1">
                <span class="fw-bold" style="width:18px;color:{{ $color }}">{{ $grade }}</span>
                <div class="progress flex-grow-1" style="height:10px">
                  <div class="progress-bar" style="width:{{ round($val/$total*100) }}%;background:{{ $color }}"></div>
                </div>
                <span class="small text-muted" style="min-width:28px;text-align:right">{{ $val }}</span>
              </div>
            @endforeach
          </div>
        </div>
      </div>

    </div>
  </div>

</div>

{{-- Menu Master Data --}}
<div class="row g-3 mt-1">
  <div class="col-12">
    <div class="card border-0 shadow-sm">
      <div class="card-body">
        <p class="small text-muted mb-3 fw-semibold">NAVIGASI MASTER DATA</p>
        <div class="d-flex gap-2 flex-wrap">
          <a href="{{ url('/data-mahasiswa') }}" class="btn btn-sm btn-outline-info">
            <i class="bi bi-people-fill me-1"></i> Mahasiswa
          </a>
          <a href="{{ url('/data-dosen') }}" class="btn btn-sm btn-outline-warning">
            <i class="bi bi-person-badge-fill me-1"></i> Dosen
          </a>
          <a href="{{ url('/data-mata-kuliah') }}" class="btn btn-sm btn-outline-success">
            <i class="bi bi-journal-bookmark-fill me-1"></i> Mata Kuliah
          </a>
          <a href="{{ url('/data-krs') }}" class="btn btn-sm btn-outline-primary">
            <i class="bi bi-card-list me-1"></i> KRS
          </a>
          <a href="{{ url('/data-jadwal') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-calendar3 me-1"></i> Jadwal
          </a>
          <a href="{{ url('/data-absensi') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-clipboard2-check me-1"></i> Absensi
          </a>
          <a href="{{ url('/data-nilai') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-bar-chart me-1"></i> Nilai
          </a>
          <a href="{{ url('/hak-akses') }}" class="btn btn-sm btn-outline-danger">
            <i class="bi bi-shield-lock-fill me-1"></i> Hak Akses
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
