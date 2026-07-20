@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Data KRS</h4>
                </div>

                <div class="card-body">

                    <form action="/update-krs/{{ $krs->id }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Mahasiswa</label>

                            <select name="mahasiswa_id"
                                    class="form-select">

                                @foreach($mahasiswa as $item)

                                <option value="{{ $item->id }}"
                                    {{ $krs->mahasiswa_id == $item->id ? 'selected' : '' }}>

                                    {{ $item->nama }}

                                </option>

                                @endforeach

                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mata Kuliah</label>

                            <select name="mata_kuliah_id"
                                    class="form-select">

                                @foreach($mataKuliah as $item)

                                <option value="{{ $item->id }}"
                                    {{ $krs->mata_kuliah_id == $item->id ? 'selected' : '' }}>

                                    {{ $item->nama_mk }}

                                </option>

                                @endforeach

                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Semester</label>

                            <input type="text"
                                   name="semester"
                                   class="form-control"
                                   value="{{ $krs->semester }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tahun Akademik</label>

                            <input type="text"
                                   name="tahun_akademik"
                                   class="form-control"
                                   value="{{ $krs->tahun_akademik }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nilai</label>

                            <input type="text"
                                   name="nilai"
                                   class="form-control"
                                   value="{{ $krs->nilai }}">
                        </div>

                        <div class="d-flex gap-2">

                            <button type="submit"
                                    class="btn btn-primary">

                                Update

                            </button>

                            <a href="{{ url('/data-krs') }}"
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