@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Mata Kuliah</h4>
                </div>

                <div class="card-body">

                    <form action="/update-mata-kuliah/{{ $mataKuliah->id }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Kode Mata Kuliah</label>

                            <input type="text"
                                   name="kode_mk"
                                   class="form-control"
                                   value="{{ $mataKuliah->kode_mk }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Mata Kuliah</label>

                            <input type="text"
                                   name="nama_mk"
                                   class="form-control"
                                   value="{{ $mataKuliah->nama_mk }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">SKS</label>

                            <input type="number"
                                   name="sks"
                                   class="form-control"
                                   value="{{ $mataKuliah->sks }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Dosen Pengajar</label>

                            <select name="dosen_id"
                                    class="form-select">

                                @foreach($dosen as $item)

                                <option value="{{ $item->id }}"
                                    {{ $mataKuliah->dosen_id == $item->id ? 'selected' : '' }}>

                                    {{ $item->nama_dosen }}

                                </option>

                                @endforeach

                            </select>
                        </div>

                        <div class="d-flex gap-2">

                            <button type="submit"
                                    class="btn btn-primary">

                                Update

                            </button>

                            <a href="{{ url('/data-mata-kuliah') }}"
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