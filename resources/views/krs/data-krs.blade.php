@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data KRS</h3>

        <a href="{{ url('/create-krs') }}" class="btn btn-primary">
            Tambah Data
        </a>
    </div>

    <div class="table-responsive">

        <table class="table table-bordered table-striped table-hover">

            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Mahasiswa</th>
                    <th>Mata Kuliah</th>
                    <th>Semester</th>
                    <th>Tahun Akademik</th>
                    <th>Nilai</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @foreach($krs as $item)

                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->mahasiswa->nama }}</td>
                    <td>{{ $item->mataKuliah->nama_mk }}</td>
                    <td>{{ $item->semester }}</td>
                    <td>{{ $item->tahun_akademik }}</td>
                    <td>{{ $item->nilai }}</td>

                    <td>

                        <a href="{{ url('/edit-krs/'.$item->id) }}"
                           class="btn btn-warning btn-sm">
                           Edit
                        </a>

                        <a href="{{ url('/hapus-krs/'.$item->id) }}"
                           class="btn btn-danger btn-sm">
                           Hapus
                        </a>

                    </td>
                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>
@endsection