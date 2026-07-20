@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">Edit Data Absensi</div>
        <div class="card-body">
            <form action="/update-absensi/{{ $absensi->id }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Mahasiswa</label>
                    <select name="mahasiswa_id" class="form-control">
                        <option value="">-- Pilih Mahasiswa --</option>
                        @foreach($mahasiswa as $item)
                        <option value="{{ $item->id }}"
                            {{ $absensi->mahasiswa_id == $item->id ? 'selected' : '' }}>
                            {{ $item->nama }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Mata Kuliah</label>
                    <select name="mata_kuliah_id" class="form-control">
                        <option value="">-- Pilih Mata Kuliah --</option>
                        @foreach($mataKuliah as $item)
                        <option value="{{ $item->id }}"
                            {{ $absensi->mata_kuliah_id == $item->id ? 'selected' : '' }}>
                            {{ $item->nama_mk }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ $absensi->tanggal }}">
                </div>

                <div class="mb-3">
                    <label>Pertemuan Ke</label>
                    <input type="number" name="pertemuan_ke" class="form-control"
                           value="{{ $absensi->pertemuan_ke }}" min="1" max="16">
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        @foreach(['Hadir','Izin','Sakit','Alpha'] as $s)
                        <option value="{{ $s }}" {{ $absensi->status == $s ? 'selected' : '' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Keterangan (opsional)</label>
                    <textarea name="keterangan" class="form-control" rows="2">{{ $absensi->keterangan }}</textarea>
                </div>

                <a href="{{ url('/data-absensi') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-warning">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
