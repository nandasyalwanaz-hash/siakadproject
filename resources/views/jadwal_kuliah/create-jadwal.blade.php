@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">Tambah Jadwal Kuliah</div>
        <div class="card-body">
            <form action="/store-jadwal" method="POST">
                @csrf

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
                    <label>Dosen</label>
                    <select name="dosen_id" class="form-control">
                        <option value="">-- Pilih Dosen --</option>
                        @foreach($dosen as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_dosen }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Hari</label>
                    <select name="hari" class="form-control">
                        <option value="">-- Pilih Hari --</option>
                        @foreach(['Senin','Selasa','Rabu','Kamis','Jumat'] as $h)
                        <option value="{{ $h }}">{{ $h }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Jam Mulai</label>
                        <input type="time" name="jam_mulai" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Jam Selesai</label>
                        <input type="time" name="jam_selesai" class="form-control">
                    </div>
                </div>

                <div class="mb-3">
                    <label>Ruangan</label>
                    <input type="text" name="ruangan" class="form-control" placeholder="Contoh: GD-A 301">
                </div>

                <div class="mb-3">
                    <label>Tahun Akademik</label>
                    <input type="text" name="tahun_akademik" class="form-control" placeholder="Contoh: 2024/2025">
                </div>

                <a href="{{ url('/data-jadwal') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
