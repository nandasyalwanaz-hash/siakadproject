@extends('layouts.app')

@section('content')
<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            Hasil Evaluasi Fuzzy — {{ $fuzzyHasil->krs->mahasiswa->nama }} ({{ $fuzzyHasil->krs->mahasiswa->nim }})
            <br><small class="text-muted">{{ $fuzzyHasil->krs->mataKuliah->nama_mk }} — {{ $fuzzyHasil->krs->tahun_akademik }}</small>
        </div>
        <div class="card-body">
            <div class="row text-center">
                <div class="col-md-3">
                    <div class="text-muted small">Kehadiran</div>
                    <div class="fs-4">{{ $fuzzyHasil->kehadiran }}%</div>
                </div>
                <div class="col-md-3">
                    <div class="text-muted small">Nilai Tugas</div>
                    <div class="fs-4">{{ $fuzzyHasil->nilai_tugas }}</div>
                </div>
                <div class="col-md-3">
                    <div class="text-muted small">Keaktifan Diskusi</div>
                    <div class="fs-4">{{ $fuzzyHasil->keaktifan_diskusi }}</div>
                </div>
                <div class="col-md-3">
                    <div class="text-muted small">Skor Evaluasi</div>
                    <div class="fs-3 fw-bold">{{ $fuzzyHasil->hasil_defuzzifikasi }}</div>
                    @php
                        $color = match($fuzzyHasil->kategori) {
                            'Sangat Memuaskan' => 'success',
                            'Lulus' => 'primary',
                            'Cukup' => 'warning',
                            default => 'danger',
                        };
                    @endphp
                    <span class="badge bg-{{ $color }} fs-6">{{ $fuzzyHasil->kategori }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Breakdown fuzzifikasi --}}
    <div class="card mb-4">
        <div class="card-header">1. Fuzzifikasi — derajat keanggotaan (μ) tiap variabel</div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-sm text-center mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Variabel</th>
                        <th>Rendah</th>
                        <th>Sedang</th>
                        <th>Tinggi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-start">Kehadiran = {{ $fuzzyHasil->kehadiran }}</td>
                        <td>{{ $detail['fuzzifikasi']['kehadiran']['Rendah'] }}</td>
                        <td>{{ $detail['fuzzifikasi']['kehadiran']['Sedang'] }}</td>
                        <td>{{ $detail['fuzzifikasi']['kehadiran']['Tinggi'] }}</td>
                    </tr>
                    <tr>
                        <td class="text-start">Nilai Tugas = {{ $fuzzyHasil->nilai_tugas }}</td>
                        <td>{{ $detail['fuzzifikasi']['nilai_tugas']['Rendah'] }}</td>
                        <td>{{ $detail['fuzzifikasi']['nilai_tugas']['Sedang'] }}</td>
                        <td>{{ $detail['fuzzifikasi']['nilai_tugas']['Tinggi'] }}</td>
                    </tr>
                    <tr>
                        <td class="text-start">Keaktifan = {{ $fuzzyHasil->keaktifan_diskusi }}</td>
                        <td>{{ $detail['fuzzifikasi']['keaktifan']['Rendah'] }}</td>
                        <td>{{ $detail['fuzzifikasi']['keaktifan']['Sedang'] }}</td>
                        <td>{{ $detail['fuzzifikasi']['keaktifan']['Tinggi'] }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Rule aktif --}}
    <div class="card mb-4">
        <div class="card-header">2. Rule Base Aktif (Mamdani, min-max)</div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-sm text-center mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Rule</th>
                        <th>Kehadiran</th>
                        <th>Nilai Tugas</th>
                        <th>Keaktifan</th>
                        <th>α (min)</th>
                        <th>THEN Output</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($detail['rule_aktif'] as $r)
                    <tr>
                        <td>{{ $r['rule'] }}</td>
                        <td>{{ $r['kehadiran'] }}</td>
                        <td>{{ $r['nilai_tugas'] }}</td>
                        <td>{{ $r['keaktifan'] }}</td>
                        <td><strong>{{ $r['alpha'] }}</strong></td>
                        <td>{{ $r['output'] }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-muted">Tidak ada rule yang aktif.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Komposisi & defuzzifikasi --}}
    <div class="card mb-4">
        <div class="card-header">3. Komposisi MAX &amp; Defuzzifikasi (weighted average)</div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-sm text-center mb-3">
                <thead class="table-light">
                    <tr>
                        <th>Himpunan Output</th>
                        <th>Gagal</th>
                        <th>Cukup</th>
                        <th>Lulus</th>
                        <th>Sangat Memuaskan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-start">α (max per himpunan)</td>
                        <td>{{ $detail['alpha_per_output']['Gagal'] }}</td>
                        <td>{{ $detail['alpha_per_output']['Cukup'] }}</td>
                        <td>{{ $detail['alpha_per_output']['Lulus'] }}</td>
                        <td>{{ $detail['alpha_per_output']['Sangat Memuaskan'] }}</td>
                    </tr>
                </tbody>
            </table>
            <p class="mb-0">
                Skor akhir crisp (z*) = Σ(α × z-representatif) / Σα =
                <strong>{{ $detail['skor'] }}</strong>
                → kategori <span class="badge bg-{{ $color }}">{{ $detail['kategori'] }}</span>
            </p>
        </div>
    </div>

    <a href="{{ route('data-fuzzy-hasil') }}" class="btn btn-secondary">Kembali</a>
    <a href="{{ route('create-fuzzy-hasil', $fuzzyHasil->krs_id) }}" class="btn btn-warning">Evaluasi Ulang</a>
    <a href="{{ route('hapus-fuzzy-hasil', $fuzzyHasil->id) }}" class="btn btn-danger"
       onclick="return confirm('Yakin hapus hasil evaluasi ini?')">Hapus</a>

</div>
@endsection
