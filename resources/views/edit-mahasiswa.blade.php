@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Data Mahasiswa</h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('update-mahasiswa', $mahasiswa->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">NIM</label>
                            <input type="text" name="nim" class="form-control" value="{{ $mahasiswa->nim }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" value="{{ $mahasiswa->nama }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control" value="{{ $mahasiswa->tempat_lahir }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" value="{{ $mahasiswa->tanggal_lahir }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select">
                                <option value="">-- Pilih --</option>
                                <option value="L" {{ $mahasiswa->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ $mahasiswa->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control">{{ $mahasiswa->alamat }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Agama</label>
                            <input type="text" name="agama" class="form-control" value="{{ $mahasiswa->agama }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">No HP</label>
                            <input type="text" name="no_hp" class="form-control" value="{{ $mahasiswa->no_hp }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $mahasiswa->email }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Prodi</label>
                            <input type="text" name="prodi" class="form-control" value="{{ $mahasiswa->prodi }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Fakultas</label>
                            <input type="text" name="fakultas" class="form-control" value="{{ $mahasiswa->fakultas }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Semester</label>
                            <input type="number" name="semester" class="form-control" value="{{ $mahasiswa->semester }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Asal Sekolah</label>
                            <input type="text" name="asal_sekolah" class="form-control" value="{{ $mahasiswa->asal_sekolah }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Ayah</label>
                            <input type="text" name="nama_ayah" class="form-control" value="{{ $mahasiswa->nama_ayah }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Ibu</label>
                            <input type="text" name="nama_ibu" class="form-control" value="{{ $mahasiswa->nama_ibu }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pekerjaan Ortu</label>
                            <input type="text" name="pekerjaan_ortu" class="form-control" value="{{ $mahasiswa->pekerjaan_ortu }}">
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>

                            <a href="{{ url('/data-mahasiswa') }}" class="btn btn-secondary">
                                Kembali
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

@endsection