@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">Tambah Data Absensi</div>
        <div class="card-body">
            <form action="/store-absensi" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Mahasiswa</label>
                    <select name="mahasiswa_id" class="form-control">
                        <option value="">-- Pilih Mahasiswa --</option>
                        @foreach($mahasiswa as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Mata Kuliah</label>
                    <select name="mata_kuliah_id" class="form-control">
                        <option value="">-- Pilih Mata Kuliah --</option>
                        @foreach($mataKuliah as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_mk }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Pertemuan Ke</label>
                    <input type="number" name="pertemuan_ke" class="form-control" min="1" max="16">
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="">-- Pilih Status --</option>
                        <option value="Hadir">Hadir</option>
                        <option value="Izin">Izin</option>
                        <option value="Sakit">Sakit</option>
                        <option value="Alpha">Alpha</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Keterangan (opsional)</label>
                    <textarea name="keterangan" class="form-control" rows="2"></textarea>
                </div>

                <a href="{{ url('/data-absensi') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
