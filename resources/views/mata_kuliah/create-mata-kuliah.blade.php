@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="card">

        <div class="card-header">
            Tambah Mata Kuliah
        </div>

        <div class="card-body">

            <form action="/store-mata-kuliah" method="POST">

                @csrf

                <div class="mb-3">
                    <label>Kode Mata Kuliah</label>

                    <input type="text"
                           name="kode_mk"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Nama Mata Kuliah</label>

                    <input type="text"
                           name="nama_mk"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>SKS</label>

                    <input type="number"
                           name="sks"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Dosen Pengajar</label>

                    <select name="dosen_id"
                            class="form-control">

                        <option value="">
                            -- Pilih Dosen --
                        </option>

                        @foreach($dosen as $item)

                        <option value="{{ $item->id }}">
                            {{ $item->nama_dosen }}
                        </option>

                        @endforeach

                    </select>
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