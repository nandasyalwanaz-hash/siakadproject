@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data Dosen</h3>

        <a href="/create-dosen" class="btn btn-primary">
            Tambah Dosen
        </a>
    </div>

    <div class="table-responsive">

        <table class="table table-bordered table-striped table-hover">

            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>NIDN</th>
                    <th>Nama Dosen</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @foreach($dosen as $d)

                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d->nidn }}</td>
                    <td>{{ $d->nama_dosen }}</td>
                    <td>{{ $d->email }}</td>
                    <td>{{ $d->no_hp }}</td>
                    <td>{{ $d->alamat }}</td>

                    <td>

                        <a href="/edit-dosen/{{ $d->id }}"
                           class="btn btn-warning btn-sm">
                           Edit
                        </a>

                        <a href="/hapus-dosen/{{ $d->id }}"
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