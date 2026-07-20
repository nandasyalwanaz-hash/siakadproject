@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data Absensi</h3>
        <a href="{{ url('/create-absensi') }}" class="btn btn-primary">Tambah Data</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Mahasiswa</th>
                    <th>Mata Kuliah</th>
                    <th>Tanggal</th>
                    <th>Pertemuan Ke</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($absensi as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->mahasiswa->nama }}</td>
                    <td>{{ $item->mataKuliah->nama_mk }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td class="text-center">{{ $item->pertemuan_ke }}</td>
                    <td>
                        @if($item->status == 'Hadir')
                            <span class="badge bg-success">Hadir</span>
                        @elseif($item->status == 'Izin')
                            <span class="badge bg-warning text-dark">Izin</span>
                        @elseif($item->status == 'Sakit')
                            <span class="badge bg-info">Sakit</span>
                        @else
                            <span class="badge bg-danger">Alpha</span>
                        @endif
                    </td>
                    <td>{{ $item->keterangan ?? '-' }}</td>
                    <td>
                        <a href="{{ url('/edit-absensi/'.$item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ url('/hapus-absensi/'.$item->id) }}" class="btn btn-danger btn-sm"
                           onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
