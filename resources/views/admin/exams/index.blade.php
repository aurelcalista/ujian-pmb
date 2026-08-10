@extends('layouts.admin')

@section('title', 'Daftar Ujian - Admin CBT UCIC')
@section('page_heading', 'Daftar Ujian')

@section('admin_content')
<!-- TOP HEADER & ACTION BUTTON -->
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="fw-bold m-0 text-dark">Daftar Ujian</h4>
        <small class="text-muted">Kelola seluruh pelaksanaan ujian CBT PMB Universitas Catur Insan Cendekia</small>
    </div>
    <a href="{{ url('/admin/exams/create') }}" class="btn btn-danger px-4 py-2.5 fw-semibold rounded-3 d-inline-flex align-items-center gap-2" style="background-color: #E11D48; border: none;">
        <i class="bi bi-plus-circle-fill fs-5"></i>
        <span>Tambah Ujian</span>
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- EXAMS TABLE CARD -->
<div class="ucic-card">
    <div class="table-responsive">
        <table class="table table-ucic align-middle mb-0">
            <thead>
                <tr>
                    <th style="width: 25%;">Judul Ujian</th>
                    <th style="width: 20%;">Deskripsi / Kategori</th>
                    <th style="width: 25%;">Waktu Pelaksanaan</th>
                    <th style="width: 10%;">Durasi</th>
                    <th style="width: 10%;">Status</th>
                    <th style="width: 10%;" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($exams as $exam)
                <tr>
                    <td>
                        <div class="fw-bold text-dark" style="font-size: 0.95rem;">{{ $exam->title }}</div>
                        <small class="text-muted d-block" style="font-size: 0.72rem;">{{ $exam->questions_count }} Soal &bull; {{ $exam->sessions_count }} Peserta</small>
                    </td>
                    <td>
                        <div class="text-dark fw-medium" style="font-size: 0.88rem;">{{ $exam->description ?? 'Tes Potensi Akademik' }}</div>
                    </td>
                    <td>
                        <div class="small fw-semibold text-dark">
                            {{ $exam->start_time ? $exam->start_time->format('d M Y H:i') : '-' }}
                        </div>
                        <small class="text-muted d-block" style="font-size: 0.72rem;">
                            s/d {{ $exam->end_time ? $exam->end_time->format('d M Y H:i') : '-' }}
                        </small>
                    </td>
                    <td>
                        <span class="fw-semibold text-dark" style="font-size: 0.88rem;">{{ $exam->duration }} menit</span>
                    </td>
                    <td>
                        @if($exam->status == 'active')
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Draft</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="d-flex align-items-center justify-content-center gap-1.5">
                            <!-- Button Detail Soal dan Jawaban -->
                            <a href="{{ url('/admin/exams/' . $exam->id) }}" class="btn btn-sm btn-outline-info p-2 rounded-2" title="Detail Soal dan Jawaban" style="width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center;">
                                <i class="bi bi-card-list fs-6"></i>
                            </a>

                            <!-- Button Edit Ujian -->
                            <a href="{{ url('/admin/exams/' . $exam->id . '/edit') }}" class="btn btn-sm btn-outline-warning p-2 rounded-2" title="Edit Ujian & Soal" style="width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center;">
                                <i class="bi bi-pencil-square fs-6"></i>
                            </a>

                            <!-- Button Hapus Ujian -->
                            <form action="{{ url('/admin/exams/' . $exam->id) }}" method="POST" id="deleteForm{{ $exam->id }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-outline-danger p-2 rounded-2 btn-delete-exam" data-id="{{ $exam->id }}" title="Hapus Ujian" style="width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-trash-fill fs-6"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">
                        <i class="bi bi-journal-x fs-1 d-block mb-2 text-muted"></i>
                        <h6>Belum ada daftar ujian yang dibuat.</h6>
                        <p class="small mb-3">Klik tombol "Tambah Ujian" di atas untuk membuat ujian baru.</p>
                        <a href="{{ url('/admin/exams/create') }}" class="btn btn-danger btn-sm px-4 rounded-pill">Tambah Ujian Baru</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($exams->hasPages())
    <div class="ucic-card-footer border-top bg-white p-3">
        {{ $exams->links() }}
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.btn-delete-exam');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const examId = this.getAttribute('data-id');
            const form = document.getElementById('deleteForm' + examId);
            
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Ujian ini beserta seluruh soalnya akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus Ujian!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>
@endpush
