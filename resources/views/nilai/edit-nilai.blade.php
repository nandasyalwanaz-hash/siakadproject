@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">Edit Data Nilai</div>
        <div class="card-body">
            <form action="/update-nilai/{{ $nilai->id }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>KRS (Mahasiswa - Mata Kuliah)</label>
                    <select name="krs_id" class="form-control">
                        <option value="">-- Pilih KRS --</option>
                        @foreach($krs as $item)
                        <option value="{{ $item->id }}"
                            {{ $nilai->krs_id == $item->id ? 'selected' : '' }}>
                            {{ $item->mahasiswa->nama }} — {{ $item->mataKuliah->nama_mk }}
                            ({{ $item->semester }} / {{ $item->tahun_akademik }})
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Nilai Tugas (30%)</label>
                        <input type="number" name="nilai_tugas" class="form-control"
                               value="{{ $nilai->nilai_tugas }}" min="0" max="100" step="0.01">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Nilai UTS (30%)</label>
                        <input type="number" name="nilai_uts" class="form-control"
                               value="{{ $nilai->nilai_uts }}" min="0" max="100" step="0.01">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Nilai UAS (40%)</label>
                        <input type="number" name="nilai_uas" class="form-control"
                               value="{{ $nilai->nilai_uas }}" min="0" max="100" step="0.01">
                    </div>
                </div>

                <div class="mb-3">
                    <label>Nilai Akhir (dihitung otomatis)</label>
                    <input type="text" class="form-control" value="{{ $nilai->nilai_akhir ?? '-' }}" disabled>
                </div>

                <div class="mb-3">
                    <label>Grade</label>
                    <input type="text" class="form-control" value="{{ $nilai->grade ?? '-' }}" disabled>
                </div>

                <div class="alert alert-info">
                    <small>Nilai akhir dan grade akan dihitung ulang otomatis setelah disimpan.</small>
                </div>

                <a href="{{ url('/data-nilai') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-warning">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
