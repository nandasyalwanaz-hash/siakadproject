@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3>Evaluasi Fuzzy Kelulusan Mata Kuliah</h3>
            <small class="text-muted">Prediksi skor kelulusan (Mamdani) berdasarkan kehadiran, nilai tugas, dan keaktifan diskusi</small>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Mahasiswa</th>
                    <th>Mata Kuliah</th>
                    <th>Kehadiran</th>
                    <th>Nilai Tugas</th>
                    <th>Keaktifan</th>
                    <th>Skor</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($krsList as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->mahasiswa->nama }}</td>
                    <td>{{ $item->mataKuliah->nama_mk }}</td>

                    @if($item->fuzzyHasil)
                        <td class="text-center">{{ $item->fuzzyHasil->kehadiran }}%</td>
                        <td class="text-center">{{ $item->fuzzyHasil->nilai_tugas }}</td>
                        <td class="text-center">{{ $item->fuzzyHasil->keaktifan_diskusi }}</td>
                        <td class="text-center"><strong>{{ $item->fuzzyHasil->hasil_defuzzifikasi }}</strong></td>
                        <td class="text-center">
                            @php
                                $color = match($item->fuzzyHasil->kategori) {
                                    'Sangat Memuaskan' => 'success',
                                    'Lulus' => 'primary',
                                    'Cukup' => 'warning',
                                    default => 'danger',
                                };
                            @endphp
                            <span class="badge bg-{{ $color }}">{{ $item->fuzzyHasil->kategori }}</span>
                        </td>
                        <td>
                            <a href="{{ route('show-fuzzy-hasil', $item->fuzzyHasil->id) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('create-fuzzy-hasil', $item->id) }}" class="btn btn-warning btn-sm">Evaluasi Ulang</a>
                        </td>
                    @else
                        <td class="text-center text-muted" colspan="5">Belum dievaluasi</td>
                        <td>
                            <a href="{{ route('create-fuzzy-hasil', $item->id) }}" class="btn btn-primary btn-sm">Evaluasi Sekarang</a>
                        </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center text-muted">Belum ada data KRS.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
