@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="card">

        <div class="card-header">
            Tambah Data KRS
        </div>

        <div class="card-body">

            <form action="/store-krs" method="POST">

                @csrf

                <div class="mb-3">
                    <label>Mahasiswa</label>

                    <select name="mahasiswa_id"
                            class="form-control">

                        <option value="">
                            -- Pilih Mahasiswa --
                        </option>

                        @foreach($mahasiswa as $item)

                        <option value="{{ $item->id }}">
                            {{ $item->nama }}
                        </option>

                        @endforeach

                    </select>
                </div>

                <div class="mb-3">
                    <label>Mata Kuliah</label>

                    <select name="mata_kuliah_id"
                            class="form-control">

                        <option value="">
                            -- Pilih Mata Kuliah --
                        </option>

                        @foreach($mataKuliah as $item)

                        <option value="{{ $item->id }}">
                            {{ $item->nama_mk }}
                        </option>

                        @endforeach

                    </select>
                </div>

                <div class="mb-3">
                    <label>Semester</label>

                    <input type="text"
                           name="semester"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Tahun Akademik</label>

                    <input type="text"
                           name="tahun_akademik"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Nilai</label>

                    <input type="text"
                           name="nilai"
                           class="form-control">
                </div>

                <button type="submit"
                        class="btn btn-success">

                    Simpan

                </button>

            </form>

        </div>

    </div>

</div>

@endsection