@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data Jadwal Kuliah</h3>
        <a href="{{ url('/create-jadwal') }}" class="btn btn-primary">Tambah Data</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Mata Kuliah</th>
                    <th>Dosen</th>
                    <th>Hari</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Ruangan</th>
                    <th>Tahun Akademik</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jadwal as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->mataKuliah->nama_mk }}</td>
                    <td>{{ $item->dosen->nama_dosen }}</td>
                    <td>{{ $item->hari }}</td>
                    <td>{{ $item->jam_mulai }}</td>
                    <td>{{ $item->jam_selesai }}</td>
                    <td>{{ $item->ruangan }}</td>
                    <td>{{ $item->tahun_akademik }}</td>
                    <td>
                        <a href="{{ url('/edit-jadwal/'.$item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ url('/hapus-jadwal/'.$item->id) }}" class="btn btn-danger btn-sm"
                           onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
