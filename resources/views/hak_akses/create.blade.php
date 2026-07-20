@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Tambah Hak Akses</h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('store-hak-akses') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nama Role</label>
                            <input type="text" name="role" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Modul</label>
                            <input type="text" name="modul" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Permission</label>
                            <div class="d-flex flex-column gap-2">
                                <div class="form-check">
                                    <input type="checkbox" name="can_view" value="1" class="form-check-input" id="can_view">
                                    <label class="form-check-label" for="can_view">Dapat Lihat</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="can_create" value="1" class="form-check-input" id="can_create">
                                    <label class="form-check-label" for="can_create">Dapat Tambah</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="can_edit" value="1" class="form-check-input" id="can_edit">
                                    <label class="form-check-label" for="can_edit">Dapat Edit</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="can_delete" value="1" class="form-check-input" id="can_delete">
                                    <label class="form-check-label" for="can_delete">Dapat Hapus</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('hak-akses') }}" class="btn btn-secondary">Kembali</a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection 