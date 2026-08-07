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
                        <h6 class="fw-bold m-0 text-dark">Total Bank Soal: 150 Soal</h6>
                        <small class="text-muted">Kategori: Tes Potensi Akademik & Bahasa Inggris</small>
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

<!-- QUESTIONS LIST CARDS -->
<div class="space-y-4">
    
    <!-- Question Card Item 1 -->
    <div class="ucic-card mb-4">
        <div class="ucic-card-header bg-light d-flex align-items-center justify-content-between py-2.5">
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-ucic-primary px-3 py-1.5 rounded-pill">Soal #1</span>
                <span class="badge bg-secondary text-white">Tes Potensi Akademik</span>
                <small class="text-muted ms-2">Bobot: 2 Poin</small>
            </div>

            <div class="btn-group btn-group-sm">
                <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#addQuestionModal" title="Edit Soal">
                    <i class="bi bi-pencil-square me-1"></i> Edit
                </button>
                <button class="btn btn-outline-danger" onclick="confirm('Apakah Anda yakin ingin menghapus soal ini?');" title="Hapus Soal">
                    <i class="bi bi-trash-fill"></i>
                </button>
            </div>
        </div>

        <div class="ucic-card-body p-4">
            <p class="fw-semibold text-dark mb-3" style="font-size: 1.05rem;">
                Manakah di antara pernyataan berikut yang paling tepat mengenai prinsip dasar pengembangan sistem informasi berbasis jaringan komputer di lingkungan perguruan tinggi?
            </p>

            <div class="row g-2">
                <div class="col-md-6">
                    <div class="p-2.5 rounded-3 border bg-success-subtle border-success text-success fw-medium small d-flex align-items-center gap-2">
                        <span class="badge bg-success">A</span>
                        <span>Mengutamakan skabilitas, keamanan data, dan integrasi antar layanan...</span>
                        <i class="bi bi-check-circle-fill ms-auto fs-5"></i>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-2.5 rounded-3 border bg-light text-muted small d-flex align-items-center gap-2">
                        <span class="badge bg-secondary">B</span>
                        <span>Membatasi akses seluruh mahasiswa agar data tidak dapat diakses...</span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-2.5 rounded-3 border bg-light text-muted small d-flex align-items-center gap-2">
                        <span class="badge bg-secondary">C</span>
                        <span>Menggunakan perangkat keras dengan spesifikasi paling sederhana...</span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-2.5 rounded-3 border bg-light text-muted small d-flex align-items-center gap-2">
                        <span class="badge bg-secondary">D</span>
                        <span>Menghilangkan peran server pusat dan menggantikannya secara manual...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Question Card Item 2 -->
    <div class="ucic-card mb-4">
        <div class="ucic-card-header bg-light d-flex align-items-center justify-content-between py-2.5">
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-ucic-primary px-3 py-1.5 rounded-pill">Soal #2</span>
                <span class="badge bg-info text-white">Bahasa Inggris</span>
                <small class="text-muted ms-2">Bobot: 2 Poin</small>
            </div>

            <div class="btn-group btn-group-sm">
                <button class="btn btn-outline-secondary"><i class="bi bi-pencil-square me-1"></i> Edit</button>
                <button class="btn btn-outline-danger"><i class="bi bi-trash-fill"></i></button>
            </div>
        </div>

        <div class="ucic-card-body p-4">
            <p class="fw-semibold text-dark mb-3" style="font-size: 1.05rem;">
                Choose the correct sentence that uses the Present Perfect Continuous tense correctly:
            </p>

            <div class="row g-2">
                <div class="col-md-6">
                    <div class="p-2.5 rounded-3 border bg-light text-muted small d-flex align-items-center gap-2">
                        <span class="badge bg-secondary">A</span>
                        <span>They have been studying for the exam since two hours.</span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-2.5 rounded-3 border bg-success-subtle border-success text-success fw-medium small d-flex align-items-center gap-2">
                        <span class="badge bg-success">B</span>
                        <span>They have been studying for the exam for two hours.</span>
                        <i class="bi bi-check-circle-fill ms-auto fs-5"></i>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-2.5 rounded-3 border bg-light text-muted small d-flex align-items-center gap-2">
                        <span class="badge bg-secondary">C</span>
                        <span>They are studying for the exam since morning.</span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-2.5 rounded-3 border bg-light text-muted small d-flex align-items-center gap-2">
                        <span class="badge bg-secondary">D</span>
                        <span>They studied for the exam for two hours ago.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- MODAL ADD/EDIT QUESTION -->
<div class="modal fade" id="addQuestionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header bg-ucic-primary text-white" style="border-radius: 18px 18px 0 0;">
                <h5 class="modal-title fw-bold">Tambah / Edit Soal Ujian</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form action="#" onsubmit="alert('Soal berhasil disimpan!'); return false;">
                    <div class="mb-3">
                        <label class="form-label-ucic">Kategori Soal</label>
                        <select class="form-select form-select-ucic">
                            <option>Tes Potensi Akademik</option>
                            <option>Bahasa Inggris</option>
                            <option>Penalaran Logika</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label-ucic">Pertanyaan / Pertanyaan Ujian</label>
                        <textarea class="form-control form-control-ucic" rows="3" placeholder="Tuliskan isi pertanyaan soal..."></textarea>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label-ucic">Pilihan A</label>
                            <input type="text" class="form-control form-control-ucic" placeholder="Jawaban Opsi A">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-ucic">Pilihan B</label>
                            <input type="text" class="form-control form-control-ucic" placeholder="Jawaban Opsi B">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-ucic">Pilihan C</label>
                            <input type="text" class="form-control form-control-ucic" placeholder="Jawaban Opsi C">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-ucic">Pilihan D</label>
                            <input type="text" class="form-control form-control-ucic" placeholder="Jawaban Opsi D">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label-ucic">Kunci Jawaban Benar</label>
                        <select class="form-select form-select-ucic">
                            <option value="A">Pilihan A</option>
                            <option value="B">Pilihan B</option>
                            <option value="C">Pilihan C</option>
                            <option value="D">Pilihan D</option>
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
