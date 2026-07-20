@extends('layouts.app')

@section('content')

{{-- ── Greeting ── --}}
<div class="d-flex align-items-center justify-content-between mb-4">
  <div>
    <h4 class="mb-0 fw-semibold" style="color:#2c3a54">
      Selamat datang, {{ $dosen->nama ?? auth()->user()->name }} 👋
    </h4>
    <small class="text-muted">
      {{ $dosen ? 'NIDN: '.$dosen->nidn.' · '.$dosen->bidang_keahlian : '' }}
      &mdash; {{ now()->isoFormat('dddd, D MMMM Y') }}
    </small>
  </div>
  <span class="badge fw-normal px-3 py-2" style="background:rgba(255,193,7,.2);color:#ffc107;font-size:.8rem">
    <i class="bi bi-person-badge-fill me-1"></i> Dosen
  </span>
</div>

{{-- ── Stat Cards ── --}}
<div class="row g-3 mb-4">

  <div class="col-6 col-md-3">
    <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #47b2e4 !important">
      <div class="card-body">
        <div class="d-flex align-items-center gap-3">
          <div class="rounded-circle d-flex align-items-center justify-content-center"
               style="width:46px;height:46px;background:rgba(71,178,228,.15)">
            <i class="bi bi-journal-bookmark-fill" style="color:#47b2e4;font-size:1.2rem"></i>
          </div>
          <div>
            <div class="fs-3 fw-bold" style="color:#2c3a54">{{ $stats['total_matkul_ajar'] }}</div>
            <div class="text-muted small">Mata Kuliah Ajar</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-6 col-md-3">
    <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #5dd68c !important">
      <div class="card-body">
        <div class="d-flex align-items-center gap-3">
          <div class="rounded-circle d-flex align-items-center justify-content-center"
               style="width:46px;height:46px;background:rgba(93,214,140,.15)">
            <i class="bi bi-people-fill" style="color:#5dd68c;font-size:1.2rem"></i>
          </div>
          <div>
            <div class="fs-3 fw-bold" style="color:#2c3a54">{{ $stats['total_mahasiswa'] }}</div>
            <div class="text-muted small">Mahasiswa Diajar</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-6 col-md-3">
    <div class="card border-0 shadow-sm h-100"
         style="border-left: 4px solid {{ $stats['belum_dinilai'] > 0 ? '#f77' : '#5dd68c' }} !important">
      <div class="card-body">
        <div class="d-flex align-items-center gap-3">
          <div class="rounded-circle d-flex align-items-center justify-content-center"
               style="width:46px;height:46px;background:rgba(255,119,119,.15)">
            <i class="bi bi-exclamation-triangle-fill"
               style="color:{{ $stats['belum_dinilai'] > 0 ? '#f77' : '#5dd68c' }};font-size:1.2rem"></i>
          </div>
          <div>
            <div class="fs-3 fw-bold" style="color:#2c3a54">{{ $stats['belum_dinilai'] }}</div>
            <div class="text-muted small">Belum Dinilai</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-6 col-md-3">
    <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #ffc107 !important">
      <div class="card-body">
        <div class="d-flex align-items-center gap-3">
          <div class="rounded-circle d-flex align-items-center justify-content-center"
               style="width:46px;height:46px;background:rgba(255,193,7,.15)">
            <i class="bi bi-clipboard2-check-fill" style="color:#ffc107;font-size:1.2rem"></i>
          </div>
          <div>
            <div class="fs-3 fw-bold" style="color:#2c3a54">{{ $stats['absensi_hari_ini'] }}</div>
            <div class="text-muted small">Absensi Hari Ini</div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<div class="row g-3">

  {{-- Jadwal Mengajar Hari Ini --}}
  <div class="col-md-5">
    <div class="card border-0 shadow-sm h-100">
      <div class="card-header bg-white border-0 d-flex align-items-center gap-2 pt-3">
        <i class="bi bi-calendar3" style="color:#47b2e4"></i>
        <span class="fw-semibold">Jadwal Mengajar Hari Ini</span>
        <span class="badge bg-warning text-dark ms-auto">{{ now()->isoFormat('dddd') }}</span>
      </div>
      <div class="card-body py-2">
        @forelse($jadwalHariIni as $jadwal)
          <div class="d-flex gap-3 align-items-start py-2 border-bottom border-light">
            <div class="text-center" style="min-width:60px">
              <div class="small fw-bold text-primary">{{ substr($jadwal->jam_mulai, 0, 5) }}</div>
              <div class="small text-muted">{{ substr($jadwal->jam_selesai, 0, 5) }}</div>
            </div>
            <div>
              <div class="fw-semibold" style="font-size:.875rem">
                {{ optional($jadwal->mataKuliah)->nama_mata_kuliah ?? '-' }}
              </div>
              <div class="small text-muted">
                <i class="bi bi-geo-alt"></i> {{ $jadwal->ruangan ?? 'Ruang -' }}
              </div>
            </div>
          </div>
        @empty
          <div class="text-center py-4 text-muted">
            <i class="bi bi-calendar-x fs-2 d-block mb-2"></i>
            Tidak ada jadwal mengajar hari ini
          </div>
        @endforelse
      </div>
    </div>
  </div>

  {{-- Panel Aksi Cepat --}}
  <div class="col-md-7">
    <div class="card border-0 shadow-sm h-100">
      <div class="card-header bg-white border-0 pt-3">
        <span class="fw-semibold"><i class="bi bi-lightning-fill text-warning me-1"></i> Aksi Cepat</span>
      </div>
      <div class="card-body">
        <div class="row g-3">
          <div class="col-6">
            <a href="{{ url('/data-nilai') }}"
               class="card border-0 text-decoration-none h-100 text-center p-3"
               style="background:rgba(71,178,228,.08);border-radius:12px;transition:.2s"
               onmouseover="this.style.background='rgba(71,178,228,.18)'"
               onmouseout="this.style.background='rgba(71,178,228,.08)'">
              <i class="bi bi-bar-chart-fill fs-2 d-block mb-2" style="color:#47b2e4"></i>
              <span class="fw-semibold" style="color:#2c3a54;font-size:.875rem">Input Nilai</span>
              @if($stats['belum_dinilai'] > 0)
                <span class="badge bg-danger ms-1">{{ $stats['belum_dinilai'] }} pending</span>
              @endif
            </a>
          </div>
          <div class="col-6">
            <a href="{{ url('/data-absensi') }}"
               class="card border-0 text-decoration-none h-100 text-center p-3"
               style="background:rgba(93,214,140,.08);border-radius:12px;transition:.2s"
               onmouseover="this.style.background='rgba(93,214,140,.18)'"
               onmouseout="this.style.background='rgba(93,214,140,.08)'">
              <i class="bi bi-clipboard2-check-fill fs-2 d-block mb-2" style="color:#5dd68c"></i>
              <span class="fw-semibold" style="color:#2c3a54;font-size:.875rem">Input Absensi</span>
            </a>
          </div>
          <div class="col-6">
            <a href="{{ url('/data-jadwal') }}"
               class="card border-0 text-decoration-none h-100 text-center p-3"
               style="background:rgba(255,193,7,.08);border-radius:12px;transition:.2s"
               onmouseover="this.style.background='rgba(255,193,7,.18)'"
               onmouseout="this.style.background='rgba(255,193,7,.08)'">
              <i class="bi bi-calendar3 fs-2 d-block mb-2" style="color:#ffc107"></i>
              <span class="fw-semibold" style="color:#2c3a54;font-size:.875rem">Jadwal Kuliah</span>
            </a>
          </div>
          <div class="col-6">
            <div class="card border-0 h-100 text-center p-3"
                 style="background:rgba(200,200,200,.1);border-radius:12px">
              <i class="bi bi-people-fill fs-2 d-block mb-2 text-muted"></i>
              <span class="text-muted" style="font-size:.875rem">{{ $stats['total_mahasiswa'] }} Mahasiswa</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

@endsection
