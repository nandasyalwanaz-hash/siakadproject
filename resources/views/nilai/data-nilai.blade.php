@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data Nilai Mahasiswa</h3>
        <a href="{{ url('/create-nilai') }}" class="btn btn-primary">Tambah Data</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Mahasiswa</th>
                    <th>Mata Kuliah</th>
                    <th>Nilai Tugas</th>
                    <th>Nilai UTS</th>
                    <th>Nilai UAS</th>
                    <th>Nilai Akhir</th>
                    <th>Grade</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($nilai as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->krs->mahasiswa->nama }}</td>
                    <td>{{ $item->krs->mataKuliah->nama_mk }}</td>
                    <td class="text-center">{{ $item->nilai_tugas ?? '-' }}</td>
                    <td class="text-center">{{ $item->nilai_uts ?? '-' }}</td>
                    <td class="text-center">{{ $item->nilai_uas ?? '-' }}</td>
                    <td class="text-center"><strong>{{ $item->nilai_akhir ?? '-' }}</strong></td>
                    <td class="text-center">
                        @if($item->grade)
                            @php
                                $color = match(true) {
                                    in_array($item->grade, ['A','A-'])   => 'success',
                                    in_array($item->grade, ['B+','B','B-']) => 'primary',
                                    in_array($item->grade, ['C+','C'])   => 'warning',
                                    $item->grade == 'D' => 'secondary',
                                    default => 'danger',
                                };
                            @endphp
                            <span class="badge bg-{{ $color }}">{{ $item->grade }}</span>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="{{ url('/edit-nilai/'.$item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ url('/hapus-nilai/'.$item->id) }}" class="btn btn-danger btn-sm"
                           onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
