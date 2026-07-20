@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">Edit Jadwal Kuliah</div>
        <div class="card-body">
            <form action="/update-jadwal/{{ $jadwal->id }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Mata Kuliah</label>
                    <select name="mata_kuliah_id" class="form-control">
                        <option value="">-- Pilih Mata Kuliah --</option>
                        @foreach($mataKuliah as $item)
                        <option value="{{ $item->id }}"
                            {{ $jadwal->mata_kuliah_id == $item->id ? 'selected' : '' }}>
                            {{ $item->nama_mk }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Dosen</label>
                    <select name="dosen_id" class="form-control">
                        <option value="">-- Pilih Dosen --</option>
                        @foreach($dosen as $item)
                        <option value="{{ $item->id }}"
                            {{ $jadwal->dosen_id == $item->id ? 'selected' : '' }}>
                            {{ $item->nama_dosen }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Hari</label>
                    <select name="hari" class="form-control">
                        @foreach(['Senin','Selasa','Rabu','Kamis','Jumat'] as $h)
                        <option value="{{ $h }}" {{ $jadwal->hari == $h ? 'selected' : '' }}>{{ $h }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Jam Mulai</label>
                        <input type="time" name="jam_mulai" class="form-control" value="{{ $jadwal->jam_mulai }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Jam Selesai</label>
                        <input type="time" name="jam_selesai" class="form-control" value="{{ $jadwal->jam_selesai }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label>Ruangan</label>
                    <input type="text" name="ruangan" class="form-control" value="{{ $jadwal->ruangan }}">
                </div>

                <div class="mb-3">
                    <label>Tahun Akademik</label>
                    <input type="text" name="tahun_akademik" class="form-control" value="{{ $jadwal->tahun_akademik }}">
                </div>

                <a href="{{ url('/data-jadwal') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-warning">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
