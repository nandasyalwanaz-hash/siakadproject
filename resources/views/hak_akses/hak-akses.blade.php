@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="card shadow">

                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Data Hak Akses</h4>
                    <a href="{{ route('create-hak-akses') }}" class="btn btn-light btn-sm">
                        + Tambah Hak Akses
                    </a>
                </div>

                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-primary">
                                <tr>
                                    <th width="50">No</th>
                                    <th>Nama Role</th>
                                    <th>Modul</th>
                                    <th>Dapat Lihat</th>
                                    <th>Dapat Tambah</th>
                                    <th>Dapat Edit</th>
                                    <th>Dapat Hapus</th>
                                    <th width="150">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($hakAkses as $index => $item)
                                <tr>
                                    <td>{{ $hakAkses->firstItem() + $index }}</td>
                                    <td>{{ $item->role }}</td>
                                    <td>{{ $item->modul }}</td>
                                    <td class="text-center">
                                        @if($item->can_view)
                                            <span class="badge bg-success">Ya</span>
                                        @else
                                            <span class="badge bg-danger">Tidak</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($item->can_create)
                                            <span class="badge bg-success">Ya</span>
                                        @else
                                            <span class="badge bg-danger">Tidak</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($item->can_edit)
                                            <span class="badge bg-success">Ya</span>
                                        @else
                                            <span class="badge bg-danger">Tidak</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($item->can_delete)
                                            <span class="badge bg-success">Ya</span>
                                        @else
                                            <span class="badge bg-danger">Tidak</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('edit-hak-akses', $item->id) }}" class="btn btn-warning btn-sm">
                                                Edit
                                            </a>
                                            <form action="{{ route('delete-hak-akses', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted">Belum ada data hak akses.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end">
                        {{ $hakAkses->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>

@endsection