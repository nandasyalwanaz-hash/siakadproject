@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            Evaluasi Fuzzy — {{ $krs->mahasiswa->nama }} ({{ $krs->mahasiswa->nim }})
            <br><small class="text-muted">{{ $krs->mataKuliah->nama_mk }} — {{ $krs->tahun_akademik }}</small>
        </div>
        <div class="card-body">

            <form action="{{ route('store-fuzzy-hasil') }}" method="POST">
                @csrf
                <input type="hidden" name="krs_id" value="{{ $krs->id }}">

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Kehadiran (%)</label>
                        <input type="number" name="kehadiran" class="form-control"
                               min="0" max="100" step="0.01"
                               value="{{ old('kehadiran', $kehadiran) }}" required>
                        <small class="text-muted">
                            Prefill otomatis: {{ $totalHadir }} hadir dari {{ $totalPertemuan }} pertemuan tercatat.
                            Bisa disesuaikan bila perlu.
                        </small>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Nilai Tugas</label>
                        <input type="number" name="nilai_tugas" class="form-control"
                               min="0" max="100" step="0.01"
                               value="{{ old('nilai_tugas', $nilaiTugas) }}" required>
                        <small class="text-muted">
                            @if($nilaiTugas !== null)
                                Prefill otomatis dari data nilai tugas mahasiswa.
                            @else
                                Nilai tugas belum diinput di modul Nilai — isi manual.
                            @endif
                        </small>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Keaktifan Diskusi</label>
                        <input type="number" name="keaktifan_diskusi" class="form-control"
                               min="0" max="100" step="0.01"
                               value="{{ old('keaktifan_diskusi', optional($krs->fuzzyHasil)->keaktifan_diskusi) }}"
                               placeholder="0 - 100" required>
                        <small class="text-muted">Dinilai manual oleh dosen, skala 0–100.</small>
                    </div>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="alert alert-info">
                    <small>
                        Sistem akan menghitung fuzzifikasi 3 variabel input, menerapkan 14 rule base (Mamdani, min-max),
                        lalu melakukan defuzzifikasi (weighted average) untuk mendapatkan skor crisp 0–100
                        beserta kategori (Gagal / Cukup / Lulus / Sangat Memuaskan).
                    </small>
                </div>

                <a href="{{ route('data-fuzzy-hasil') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-success">Hitung &amp; Simpan</button>
            </form>

        </div>
    </div>
</div>
@endsection
