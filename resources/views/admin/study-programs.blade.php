@extends('layouts.admin')

@section('title', 'Program Studi - Admin Panel CBT PMB UCIC')
@section('page_heading', 'Manajemen Program Studi')

@section('admin_content')
<div class="row g-4">
    <!-- Form Tambah Prodi -->
    <div class="col-lg-4">
        <div class="ucic-card">
            <div class="ucic-card-header">
                <h6 class="fw-bold m-0 text-dark">Tambah Program Studi</h6>
            </div>
            <div class="ucic-card-body p-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                <form action="{{ url('/admin/study-programs') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Nama Program Studi</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan program studi" required>
                    </div>
                    <button type="submit" class="btn btn-ucic-primary w-100">Simpan Prodi</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Tabel Daftar Prodi -->
    <div class="col-lg-8">
        <div class="ucic-card h-100">
            <div class="ucic-card-header">
                <h6 class="fw-bold m-0 text-dark">Daftar Program Studi</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-ucic align-middle mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Program Studi</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($studyPrograms as $index => $prodi)
                        <tr>
                            <td>{{ $studyPrograms->firstItem() + $index }}</td>
                            <td class="fw-semibold text-dark">{{ $prodi->name }}</td>
                            <td class="text-end">
                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $prodi->id }}">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger ms-1" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $prodi->id }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-muted">Belum ada data program studi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($studyPrograms->hasPages())
            <div class="ucic-card-footer border-top bg-white p-3">
                {{ $studyPrograms->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Modals (Rendered outside table to prevent HTML stripping) -->
@foreach($studyPrograms as $prodi)
<!-- Edit Modal -->
<div class="modal fade" id="editModal{{ $prodi->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ url('/admin/study-programs/' . $prodi->id) }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Edit Program Studi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Program Studi</label>
                        <input type="text" class="form-control" name="name" value="{{ $prodi->name }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal{{ $prodi->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <form action="{{ url('/admin/study-programs/' . $prodi->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content text-center">
                <div class="modal-body p-4">
                    <i class="bi bi-exclamation-triangle-fill text-danger fs-1 mb-3 d-block"></i>
                    <h5 class="fw-bold mb-2">Hapus Prodi?</h5>
                    <p class="text-muted small mb-4">Apakah Anda yakin ingin menghapus "<b>{{ $prodi->name }}</b>"? Data yang dihapus tidak bisa dikembalikan.</p>
                    <div class="d-flex gap-2 justify-content-center">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach
@endsection
