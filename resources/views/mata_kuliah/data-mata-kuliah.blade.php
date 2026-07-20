@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data Mata Kuliah</h3>

        <a href="{{ url('/create-mata-kuliah') }}" class="btn btn-primary">
            Tambah Data
        </a>
    </div>

    <div class="table-responsive">

        <table class="table table-bordered table-striped table-hover">

            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Kode MK</th>
                    <th>Nama Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Dosen Pengajar</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @foreach($mataKuliah as $item)

                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->kode_mk }}</td>
                    <td>{{ $item->nama_mk }}</td>
                    <td>{{ $item->sks }}</td>

                    <td>
                        {{ $item->dosen->nama_dosen ?? '-' }}
                    </td>

                    <td>

                        <a href="{{ url('/edit-mata-kuliah/'.$item->id) }}"
                           class="btn btn-warning btn-sm">
                           Edit
                        </a>

                        <a href="{{ url('/hapus-mata-kuliah/'.$item->id) }}"
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