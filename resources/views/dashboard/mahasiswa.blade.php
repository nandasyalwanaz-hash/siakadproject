@extends('layouts.app')

@section('content')

{{-- ── Greeting ── --}}
<div class="d-flex align-items-center justify-content-between mb-4">
  <div>
    <h4 class="mb-0 fw-semibold" style="color:#2c3a54">
      Selamat datang, {{ $mahasiswa->nama ?? auth()->user()->name }} 👋
    </h4>
    <small class="text-muted">
      {{ $mahasiswa ? $mahasiswa->prodi.' · '.$mahasiswa->fakultas : '' }} &mdash; {{ now()->isoFormat('dddd, D MMMM Y') }}
    </small>
  </div>
  @if($mahasiswa)
    <span class="badge bg-primary fs-6 px-3 py-2">NIM: {{ $mahasiswa->nim }}</span>
  @endif
</div>

{{-- ── Stat Cards ── --}}
<div class="row g-3 mb-4">

  {{-- SKS --}}
  <div class="col-6 col-md-3">
    <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #47b2e4 !important">
      <div class="card-body">
        <div class="d-flex align-items-center gap-3">
          <div class="rounded-circle d-flex align-items-center justify-content-center"
               style="width:46px;height:46px;background:rgba(71,178,228,.15)">
            <i class="bi bi-book-fill" style="color:#47b2e4;font-size:1.2rem"></i>
          </div>
          <div>
            <div class="fs-3 fw-bold" style="color:#2c3a54">{{ $stats['total_sks'] }}</div>
            <div class="text-muted small">Total SKS</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Mata Kuliah --}}
  <div class="col-6 col-md-3">
    <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #5dd68c !important">
      <div class="card-body">
        <div class="d-flex align-items-center gap-3">
          <div class="rounded-circle d-flex align-items-center justify-content-center"
               style="width:46px;height:46px;background:rgba(93,214,140,.15)">
            <i class="bi bi-journals" style="color:#5dd68c;font-size:1.2rem"></i>
          </div>
          <div>
            <div class="fs-3 fw-bold" style="color:#2c3a54">{{ $stats['total_matkul'] }}</div>
            <div class="text-muted small">Mata Kuliah</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- IPK --}}
  <div class="col-6 col-md-3">
    <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #ffc107 !important">
      <div class="card-body">
        <div class="d-flex align-items-center gap-3">
          <div class="rounded-circle d-flex align-items-center justify-content-center"
               style="width:46px;height:46px;background:rgba(255,193,7,.15)">
            <i class="bi bi-bar-chart-fill" style="color:#ffc107;font-size:1.2rem"></i>
          </div>
          <div>
            <div class="fs-3 fw-bold" style="color:#2c3a54">{{ number_format($stats['ipk'], 2) }}</div>
            <div class="text-muted small">IPK</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Kehadiran --}}
  <div class="col-6 col-md-3">
    <div class="card border-0 shadow-sm h-100"
         style="border-left: 4px solid {{ $stats['kehadiran'] >= 75 ? '#5dd68c' : '#f77' }} !important">
      <div class="card-body">
        <div class="d-flex align-items-center gap-3">
          <div class="rounded-circle d-flex align-items-center justify-content-center"
               style="width:46px;height:46px;background:rgba(93,214,140,.15)">
            <i class="bi bi-clipboard2-check-fill"
               style="color:{{ $stats['kehadiran'] >= 75 ? '#5dd68c' : '#f77' }};font-size:1.2rem"></i>
          </div>
          <div>
            <div class="fs-3 fw-bold" style="color:#2c3a54">{{ $stats['kehadiran'] }}%</div>
            <div class="text-muted small">Kehadiran</div>
          </div>
        </div>
        {{-- Progress bar kehadiran --}}
        <div class="progress mt-2" style="height:4px">
          <div class="progress-bar {{ $stats['kehadiran'] >= 75 ? 'bg-success' : 'bg-danger' }}"
               style="width:{{ $stats['kehadiran'] }}%"></div>
        </div>
        @if($stats['kehadiran'] < 75)
          <small class="text-danger"><i class="bi bi-exclamation-triangle-fill"></i> Di bawah batas minimum</small>
        @endif
      </div>
    </div>
  </div>

</div>

<div class="row g-3">

  {{-- Jadwal Hari Ini --}}
  <div class="col-md-5">
    <div class="card border-0 shadow-sm h-100">
      <div class="card-header bg-white border-0 d-flex align-items-center gap-2 pt-3">
        <i class="bi bi-calendar3" style="color:#47b2e4"></i>
        <span class="fw-semibold">Jadwal Hari Ini</span>
        <span class="badge bg-primary ms-auto">{{ now()->isoFormat('dddd') }}</span>
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
                @if($jadwal->dosen)
                  · <i class="bi bi-person"></i> {{ $jadwal->dosen->nama ?? '' }}
                @endif
              </div>
            </div>
          </div>
        @empty
          <div class="text-center py-4 text-muted">
            <i class="bi bi-calendar-x fs-2 d-block mb-2"></i>
            Tidak ada jadwal hari ini
          </div>
        @endforelse
      </div>
    </div>
  </div>

  {{-- Nilai Terbaru --}}
  <div class="col-md-7">
    <div class="card border-0 shadow-sm h-100">
      <div class="card-header bg-white border-0 d-flex align-items-center gap-2 pt-3">
        <i class="bi bi-bar-chart-fill" style="color:#ffc107"></i>
        <span class="fw-semibold">Nilai Terbaru</span>
        <a href="{{ url('/data-nilai') }}" class="btn btn-sm btn-outline-primary ms-auto" style="font-size:.75rem">
          Lihat Semua
        </a>
      </div>
      <div class="card-body p-0">
        @forelse($nilaiTerbaru as $nilai)
          @php
            $na = $nilai->nilai_akhir ?? 0;
            $badgeClass = $na >= 85 ? 'success' : ($na >= 75 ? 'primary' : ($na >= 65 ? 'warning' : 'danger'));
          @endphp
          <div class="d-flex align-items-center px-3 py-2 border-bottom border-light gap-3">
            <div class="flex-grow-1">
              <div class="fw-semibold" style="font-size:.875rem">
                {{ optional(optional($nilai->krs)->mataKuliah)->nama_mata_kuliah ?? 'Mata Kuliah' }}
              </div>
              <div class="small text-muted">
                Tugas: {{ $nilai->nilai_tugas }} &bull;
                UTS: {{ $nilai->nilai_uts }} &bull;
                UAS: {{ $nilai->nilai_uas }}
              </div>
            </div>
            <div class="text-center">
              <span class="badge bg-{{ $badgeClass }} fs-6 px-2">{{ $nilai->grade ?? '-' }}</span>
              <div class="small text-muted">{{ $na }}</div>
            </div>
          </div>
        @empty
          <div class="text-center py-4 text-muted">
            <i class="bi bi-clipboard2-x fs-2 d-block mb-2"></i>
            Nilai belum tersedia
          </div>
        @endforelse
      </div>
      @if($nilaiTerbaru->count() > 0)
      <div class="card-footer bg-white border-0 px-3 pb-3">
        <div class="d-flex justify-content-between small text-muted">
          <span>IPK sementara:</span>
          <span class="fw-bold text-warning">{{ number_format($stats['ipk'], 2) }}</span>
        </div>
      </div>
      @endif
    </div>
  </div>

</div>

{{-- Shortcut Menu --}}
<div class="row g-3 mt-1">
  <div class="col-12">
    <div class="card border-0 shadow-sm">
      <div class="card-body">
        <p class="small text-muted mb-3 fw-semibold">AKSES CEPAT</p>
        <div class="d-flex gap-2 flex-wrap">
          <a href="{{ url('/data-krs') }}" class="btn btn-outline-primary btn-sm">
            <i class="bi bi-card-list me-1"></i> KRS Saya
          </a>
          <a href="{{ url('/data-nilai') }}" class="btn btn-outline-warning btn-sm">
            <i class="bi bi-bar-chart me-1"></i> Nilai
          </a>
          <a href="{{ url('/data-absensi') }}" class="btn btn-outline-success btn-sm">
            <i class="bi bi-clipboard2-check me-1"></i> Absensi
          </a>
          <a href="{{ url('/data-jadwal') }}" class="btn btn-outline-info btn-sm">
            <i class="bi bi-calendar3 me-1"></i> Jadwal
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
