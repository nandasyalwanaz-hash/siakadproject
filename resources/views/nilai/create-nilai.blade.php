@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">Tambah Data Nilai</div>
        <div class="card-body">
            <form action="/store-nilai" method="POST">
                @csrf

                <div class="mb-3">
                    <label>KRS (Mahasiswa - Mata Kuliah)</label>
                    <select name="krs_id" class="form-control">
                        <option value="">-- Pilih KRS --</option>
                        @foreach($krs as $item)
                        <option value="{{ $item->id }}">
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
                               min="0" max="100" step="0.01" placeholder="0 - 100">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Nilai UTS (30%)</label>
                        <input type="number" name="nilai_uts" class="form-control"
                               min="0" max="100" step="0.01" placeholder="0 - 100">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Nilai UAS (40%)</label>
                        <input type="number" name="nilai_uas" class="form-control"
                               min="0" max="100" step="0.01" placeholder="0 - 100">
                    </div>
                </div>

                <div class="alert alert-info">
                    <small>Nilai akhir dan grade akan dihitung otomatis oleh sistem.<br>
                    Rumus: <strong>(Tugas × 30%) + (UTS × 30%) + (UAS × 40%)</strong></small>
                </div>

                <a href="{{ url('/data-nilai') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
