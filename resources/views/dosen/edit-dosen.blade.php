@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Data Dosen</h4>
                </div>

                <div class="card-body">

                    <form action="/update-dosen/{{ $dosen->id }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">NIDN</label>

                            <input type="text"
                                   name="nidn"
                                   class="form-control"
                                   value="{{ $dosen->nidn }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Dosen</label>

                            <input type="text"
                                   name="nama_dosen"
                                   class="form-control"
                                   value="{{ $dosen->nama_dosen }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>

                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   value="{{ $dosen->email }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">No HP</label>

                            <input type="text"
                                   name="no_hp"
                                   class="form-control"
                                   value="{{ $dosen->no_hp }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>

                            <textarea name="alamat"
                                      class="form-control">{{ $dosen->alamat }}</textarea>
                        </div>

                        <div class="d-flex gap-2">

                            <button type="submit"
                                    class="btn btn-primary">

                                Update

                            </button>

                            <a href="{{ url('/data-dosen') }}"
                               class="btn btn-secondary">

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