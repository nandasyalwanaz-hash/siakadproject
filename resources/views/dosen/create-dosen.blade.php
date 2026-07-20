@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="card">

        <div class="card-header">
            Tambah Dosen
        </div>

        <div class="card-body">

            <form action="/store-dosen" method="POST">

                @csrf

                <div class="mb-3">
                    <label>NIDN</label>
                    <input type="text"
                           name="nidn"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Nama Dosen</label>
                    <input type="text"
                           name="nama_dosen"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email"
                           name="email"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>No HP</label>
                    <input type="text"
                           name="no_hp"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Alamat</label>

                    <textarea name="alamat"
                              class="form-control"></textarea>
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