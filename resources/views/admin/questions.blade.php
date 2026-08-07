@extends('layouts.admin')

@section('title', 'Bank Soal - Admin CBT UCIC')
@section('page_heading', 'Kelola Bank Soal Ujian')

@section('admin_content')
<!-- TOOLBAR & HEADER -->
<div class="ucic-card mb-4">
    <div class="ucic-card-body py-3">
        <div class="row align-items-center g-3">
            <div class="col-md-6">
                <div class="d-flex align-items-center gap-3">
                    <span class="stat-icon primary" style="width: 44px; height: 44px; font-size: 1.2rem;">
                        <i class="bi bi-journal-text"></i>
                    </span>
                    <div>
                        <h6 class="fw-bold m-0 text-dark">Total Bank Soal: {{ count($questions) }} Soal</h6>
                        <small class="text-muted">Ujian: {{ $exam->title ?? 'PMB UCIC' }}</small>
                    </div>
                </div>
            </div>

            <div class="col-md-6 text-md-end">
                <button class="btn btn-ucic-primary btn-sm px-3 py-2 fw-semibold rounded-3" data-bs-toggle="modal" data-bs-target="#addQuestionModal">
                    <i class="bi bi-plus-circle-fill me-1"></i> Tambah Soal Baru
                </button>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- QUESTIONS LIST CARDS -->
<div class="space-y-4">
    @forelse($questions as $index => $q)
    <div class="ucic-card mb-4">
        <div class="ucic-card-header bg-light d-flex align-items-center justify-content-between py-2.5">
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-ucic-primary px-3 py-1.5 rounded-pill">Soal #{{ $index + 1 }}</span>
                <small class="text-muted ms-2">Bobot: {{ $q->weight }} Poin</small>
            </div>

            <div class="btn-group btn-group-sm">
                <form action="{{ url('/admin/questions/' . $q->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus soal ini?');" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Hapus Soal">
                        <i class="bi bi-trash-fill"></i> Hapus
                    </button>
                </form>
            </div>
        </div>

        <div class="ucic-card-body p-4">
            <p class="fw-semibold text-dark mb-3" style="font-size: 1.02rem;">
                {!! nl2br(e($q->question_text)) !!}
            </p>

            <div class="row g-2">
                @foreach($q->options as $optIdx => $opt)
                <div class="col-md-6">
                    @if($opt->is_correct)
                    <div class="p-2.5 rounded-3 border bg-success-subtle border-success text-success fw-medium small d-flex align-items-center gap-2">
                        <span class="badge bg-success">{{ chr(65 + $optIdx) }}</span>
                        <span>{{ $opt->option_text }}</span>
                        <i class="bi bi-check-circle-fill ms-auto fs-5"></i>
                    </div>
                    @else
                    <div class="p-2.5 rounded-3 border bg-light text-muted small d-flex align-items-center gap-2">
                        <span class="badge bg-secondary">{{ chr(65 + $optIdx) }}</span>
                        <span>{{ $opt->option_text }}</span>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @empty
    <div class="ucic-card p-5 text-center text-muted">
        <i class="bi bi-journal-x fs-1 text-muted d-block mb-2"></i>
        <h6>Belum ada soal dalam ujian ini.</h6>
        <p class="small mb-3">Klik tombol "Tambah Soal Baru" untuk menambahkan soal pilihan ganda.</p>
    </div>
    @endforelse
</div>

<!-- MODAL ADD QUESTION -->
<div class="modal fade" id="addQuestionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header bg-ucic-primary text-white" style="border-radius: 18px 18px 0 0;">
                <h5 class="modal-title fw-bold fs-6">Tambah Soal Pilihan Ganda Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form action="{{ url('/admin/questions') }}" method="POST">
                    @csrf
                    <input type="hidden" name="exam_id" value="{{ $exam->id ?? 1 }}">

                    <div class="row g-3 mb-3">
                        <div class="col-md-8">
                            <label class="form-label-ucic">Pertanyaan Soal <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-ucic">Bobot Nilai <span class="text-danger">*</span></label>
                            <input type="number" step="0.5" class="form-control form-control-ucic" name="weight" value="2.0" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <textarea class="form-control form-control-ucic" name="question_text" rows="3" placeholder="Tuliskan isi teks pertanyaan soal..." required></textarea>
                    </div>

                    <label class="form-label-ucic mb-2">Pilihan Jawaban (Minimal 2 Opsi)</label>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted">A</span>
                                <input type="text" class="form-control form-control-ucic" name="options[]" placeholder="Jawaban Opsi A" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted">B</span>
                                <input type="text" class="form-control form-control-ucic" name="options[]" placeholder="Jawaban Opsi B" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted">C</span>
                                <input type="text" class="form-control form-control-ucic" name="options[]" placeholder="Jawaban Opsi C">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted">D</span>
                                <input type="text" class="form-control form-control-ucic" name="options[]" placeholder="Jawaban Opsi D">
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label-ucic">Kunci Jawaban Benar <span class="text-danger">*</span></label>
                        <select class="form-select form-select-ucic" name="correct_option" required>
                            <option value="0">Pilihan A</option>
                            <option value="1">Pilihan B</option>
                            <option value="2">Pilihan C</option>
                            <option value="3">Pilihan D</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-ucic-primary px-4">Simpan Soal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
