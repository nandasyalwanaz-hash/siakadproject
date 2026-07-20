@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data Mahasiswa</h3>

        <a href="{{ route('create-mahasiswa') }}" class="btn btn-primary">
            Tambah Data
        </a>
    </div>

    <div class="table-responsive">

        <table class="table table-bordered table-striped table-hover">

            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Agama</th>
                    <th>No HP</th>
                    <th>Email</th>
                    <th>Prodi</th>
                    <th>Fakultas</th>
                    <th>Semester</th>
                    <th>Asal Sekolah</th>
                    <th>Nama Ayah</th>
                    <th>Nama Ibu</th>
                    <th>Pekerjaan Ortu</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($mahasiswa as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nim }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->tempat_lahir }}</td>
                    <td>{{ $item->tanggal_lahir }}</td>
                    <td>{{ $item->jenis_kelamin }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->agama }}</td>
                    <td>{{ $item->no_hp }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->prodi }}</td>
                    <td>{{ $item->fakultas }}</td>
                    <td>{{ $item->semester }}</td>
                    <td>{{ $item->asal_sekolah }}</td>
                    <td>{{ $item->nama_ayah }}</td>
                    <td>{{ $item->nama_ibu }}</td>
                    <td>{{ $item->pekerjaan_ortu }}</td>

                    <td>
                        <a href="{{ route('edit-mahasiswa', $item->id) }}"
                           class="btn btn-warning btn-sm">
                           Edit
                        </a>

                        <a href="{{ route('hapus-mahasiswa', $item->id) }}"
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