@extends('layouts.admin')

@section('title', 'Tambah Ujian Baru - Admin CBT UCIC')
@section('page_heading', 'Tambah Ujian Baru')

@section('admin_content')
<!-- TOP HEADER BAR -->
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="fw-bold m-0 text-dark">Tambah Ujian Baru</h4>
        <small class="text-muted">Buat pelaksanaan ujian CBT PMB baru lengkap dengan parameter dan bank soal</small>
    </div>
    <a href="{{ url('/admin/exams') }}" class="btn btn-secondary px-4 py-2.5 fw-semibold rounded-3 d-inline-flex align-items-center gap-2">
        <span>Kembali</span>
    </a>
</div>

<form action="{{ url('/admin/exams') }}" method="POST" id="createExamForm" enctype="multipart/form-data">
    @csrf

    <!-- CARD 1: INFORMASI UJIAN -->
    <div class="ucic-card mb-4">
        <div class="ucic-card-header bg-light">
            <h6 class="fw-bold m-0 text-dark">Informasi Ujian</h6>
        </div>

        <div class="ucic-card-body p-4">
            <!-- Judul Ujian -->
            <div class="mb-3">
                <label for="title" class="form-label-ucic">Judul Ujian <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-ucic" id="title" name="title" placeholder="Masukkan Judul Ujian" required>
            </div>

            <!-- Deskripsi / Kategori -->
            <div class="mb-3">
                <label for="description" class="form-label-ucic">Deskripsi / Kategori Ujian <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-ucic" id="description" name="description" placeholder="Masukkan deskripsi ujian" required>
            </div>



            <!-- Status Ujian -->
            <div class="mb-3">
                <label for="status" class="form-label-ucic">Status Ujian <span class="text-danger">*</span></label>
                <select class="form-select form-control-ucic" id="status" name="status" required>
                    <option value="draft">Draft (Disembunyikan)</option>
                    <option value="active" selected>Active (Ditampilkan ke Peserta)</option>
                </select>
                <small class="text-muted" style="font-size: 0.78rem;">Hanya boleh ada 1 ujian yang aktif dalam satu waktu.</small>
            </div>

            <!-- Waktu Mulai, Waktu Selesai, Durasi -->
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label for="start_time" class="form-label-ucic">Waktu Mulai <span class="text-danger">*</span></label>
                    <input type="datetime-local" class="form-control form-control-ucic" id="start_time" name="start_time" value="{{ date('Y-m-d\TH:i', strtotime('-1 hour')) }}" required>
                </div>

                <div class="col-md-4">
                    <label for="end_time" class="form-label-ucic">Waktu Selesai <span class="text-danger">*</span></label>
                    <input type="datetime-local" class="form-control form-control-ucic" id="end_time" name="end_time" value="{{ date('Y-m-d\TH:i', strtotime('+30 days')) }}" required>
                </div>

                <div class="col-md-4">
                    <label for="duration" class="form-label-ucic">Durasi (Menit) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control form-control-ucic" id="duration" name="duration" value="90" min="1" required>
                </div>
            </div>

            <!-- Toggles (Switches) -->
            <div class="border-top pt-3 space-y-3">
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="shuffle_questions" name="shuffle_questions" value="1" checked style="width: 2.5em; height: 1.25em;">
                    <label class="form-check-label text-dark fw-bold ms-2" for="shuffle_questions">
                        Acak Urutan Soal
                    </label>
                    <small class="text-muted d-block ms-2" style="font-size: 0.78rem;">Jika diaktifkan, setiap peserta akan mendapatkan urutan soal yang berbeda.</small>
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="shuffle_options" name="shuffle_options" value="1" checked style="width: 2.5em; height: 1.25em;">
                    <label class="form-check-label text-dark fw-bold ms-2" for="shuffle_options">
                        Acak Pilihan Jawaban
                    </label>
                    <small class="text-muted d-block ms-2" style="font-size: 0.78rem;">Jika diaktifkan, urutan pilihan jawaban di setiap soal akan berbeda untuk masing-masing peserta.</small>
                </div>

                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="fullscreen_enabled" name="fullscreen_enabled" value="1" checked style="width: 2.5em; height: 1.25em;">
                    <label class="form-check-label text-dark fw-bold ms-2" for="fullscreen_enabled">
                        Aktifkan Mode Layar Penuh (Fullscreen) & Anti-Cheat System
                    </label>
                    <small class="text-muted d-block ms-2" style="font-size: 0.78rem;">Setiap pelanggaran pindah tab/blur akan mencatat log dan memberikan warning langsung ke layar peserta.</small>
                </div>
            </div>
        </div>
    </div>

    <!-- CARD 2: DYNAMIC QUESTIONS BUILDER -->
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h5 class="fw-bold m-0 text-dark">Daftar Soal Ujian</h5>
    </div>

    <div id="questionsContainer" class="space-y-4">
        <!-- Question Item 1 Default -->
        <div class="ucic-card mb-4 question-card-item" data-qindex="0">
            <div class="ucic-card-header bg-light d-flex align-items-center justify-content-between py-2.5">
                <span class="fw-bold text-dark question-title-text" style="font-size: 0.95rem;">Soal #1</span>
                <button type="button" class="btn btn-outline-danger btn-sm px-3 rounded-pill btn-delete-question">
                    <i class="bi bi-x-circle me-1"></i> Hapus Soal
                </button>
            </div>

            <div class="ucic-card-body p-4">
                <div class="row g-3 mb-3">
                    <div class="col-md-9">
                        <label class="form-label-ucic">Pertanyaan <span class="text-danger">*</span></label>
                        <textarea class="form-control form-control-ucic" name="questions[0][text]" rows="3" placeholder="Tuliskan pertanyaan di sini..." required></textarea>
                        
                        <div class="mt-2">
                            <label class="form-label-ucic text-muted" style="font-size: 0.8rem;">Gambar Soal (Opsional, Maks 2MB)</label>
                            <input type="file" class="form-control form-control-sm" name="questions[0][image]" accept="image/*">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-ucic">Bobot Nilai</label>
                        <input type="number" step="0.5" class="form-control form-control-ucic" name="questions[0][weight]" value="1" min="0.5" required>
                    </div>
                </div>

                <label class="form-label-ucic mb-2">Pilihan Jawaban (Pilih salah satu radio sebagai Kunci Jawaban Benar)</label>
                
                <div class="options-group space-y-2">
                    <div class="input-group mb-2">
                        <div class="input-group-text bg-light">
                            <input type="radio" class="form-check-input mt-0" name="questions[0][correct_index]" value="0" checked title="Pilih sebagai jawaban benar">
                            <span class="ms-2 fw-bold">A</span>
                        </div>
                        <input type="text" class="form-control form-control-ucic" name="questions[0][options][0]" placeholder="Teks Pilihan A" required>
                    </div>

                    <div class="input-group mb-2">
                        <div class="input-group-text bg-light">
                            <input type="radio" class="form-check-input mt-0" name="questions[0][correct_index]" value="1" title="Pilih sebagai jawaban benar">
                            <span class="ms-2 fw-bold">B</span>
                        </div>
                        <input type="text" class="form-control form-control-ucic" name="questions[0][options][1]" placeholder="Teks Pilihan B" required>
                    </div>

                    <div class="input-group mb-2">
                        <div class="input-group-text bg-light">
                            <input type="radio" class="form-check-input mt-0" name="questions[0][correct_index]" value="2" title="Pilih sebagai jawaban benar">
                            <span class="ms-2 fw-bold">C</span>
                        </div>
                        <input type="text" class="form-control form-control-ucic" name="questions[0][options][2]" placeholder="Teks Pilihan C">
                    </div>

                    <div class="input-group mb-2">
                        <div class="input-group-text bg-light">
                            <input type="radio" class="form-check-input mt-0" name="questions[0][correct_index]" value="3" title="Pilih sebagai jawaban benar">
                            <span class="ms-2 fw-bold">D</span>
                        </div>
                        <input type="text" class="form-control form-control-ucic" name="questions[0][options][3]" placeholder="Teks Pilihan D">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 mb-2">
        <button type="button" class="btn btn-outline-primary px-4 py-2 rounded-3 fw-semibold w-100" id="btnAddQuestion" style="border-style: dashed; border-width: 2px;">
            <i class="bi bi-plus-circle-fill me-2"></i> Tambah Soal Baru
        </button>
    </div>

    <!-- ACTION SUBMIT BUTTON -->
    <div class="d-flex justify-content-end gap-3 mt-4 mb-5">
        <a href="{{ url('/admin/exams') }}" class="btn btn-light px-4 py-2.5 fw-semibold rounded-3">Batal</a>
        <button type="submit" class="btn btn-ucic-primary px-5 py-2.5 fw-bold fs-6 rounded-3">
            <i class="bi bi-check-circle-fill me-2"></i> Simpan Ujian
        </button>
    </div>
</form>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    let questionCounter = 1;

    // Dynamic Add Question Card
    document.getElementById('btnAddQuestion').addEventListener('click', function () {
        const container = document.getElementById('questionsContainer');
        const qIdx = questionCounter++;

        const cardHtml = `
            <div class="ucic-card mb-4 question-card-item" data-qindex="${qIdx}">
                <div class="ucic-card-header bg-light d-flex align-items-center justify-content-between py-2.5">
                    <span class="fw-bold text-dark question-title-text" style="font-size: 0.95rem;">Soal #${container.children.length + 1}</span>
                    <button type="button" class="btn btn-outline-danger btn-sm px-3 rounded-pill btn-delete-question">
                        <i class="bi bi-x-circle me-1"></i> Hapus Soal
                    </button>
                </div>

                <div class="ucic-card-body p-4">
                    <div class="row g-3 mb-3">
                        <div class="col-md-9">
                            <label class="form-label-ucic">Pertanyaan <span class="text-danger">*</span></label>
                            <textarea class="form-control form-control-ucic" name="questions[${qIdx}][text]" rows="3" placeholder="Tuliskan pertanyaan di sini..." required></textarea>
                            
                            <div class="mt-2">
                                <label class="form-label-ucic text-muted" style="font-size: 0.8rem;">Gambar Soal (Opsional, Maks 2MB)</label>
                                <input type="file" class="form-control form-control-sm" name="questions[${qIdx}][image]" accept="image/*">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label-ucic">Bobot Nilai</label>
                            <input type="number" step="0.5" class="form-control form-control-ucic" name="questions[${qIdx}][weight]" value="1" min="0.5" required>
                        </div>
                    </div>

                    <label class="form-label-ucic mb-2">Pilihan Jawaban (Pilih salah satu radio sebagai Kunci Jawaban Benar)</label>
                    
                    <div class="options-group space-y-2">
                        <div class="input-group mb-2">
                            <div class="input-group-text bg-light">
                                <input type="radio" class="form-check-input mt-0" name="questions[${qIdx}][correct_index]" value="0" checked title="Pilih sebagai jawaban benar">
                                <span class="ms-2 fw-bold">A</span>
                            </div>
                            <input type="text" class="form-control form-control-ucic" name="questions[${qIdx}][options][0]" placeholder="Teks Pilihan A" required>
                        </div>

                        <div class="input-group mb-2">
                            <div class="input-group-text bg-light">
                                <input type="radio" class="form-check-input mt-0" name="questions[${qIdx}][correct_index]" value="1" title="Pilih sebagai jawaban benar">
                                <span class="ms-2 fw-bold">B</span>
                            </div>
                            <input type="text" class="form-control form-control-ucic" name="questions[${qIdx}][options][1]" placeholder="Teks Pilihan B" required>
                        </div>

                        <div class="input-group mb-2">
                            <div class="input-group-text bg-light">
                                <input type="radio" class="form-check-input mt-0" name="questions[${qIdx}][correct_index]" value="2" title="Pilih sebagai jawaban benar">
                                <span class="ms-2 fw-bold">C</span>
                            </div>
                            <input type="text" class="form-control form-control-ucic" name="questions[${qIdx}][options][2]" placeholder="Teks Pilihan C">
                        </div>

                        <div class="input-group mb-2">
                            <div class="input-group-text bg-light">
                                <input type="radio" class="form-check-input mt-0" name="questions[${qIdx}][correct_index]" value="3" title="Pilih sebagai jawaban benar">
                                <span class="ms-2 fw-bold">D</span>
                            </div>
                            <input type="text" class="form-control form-control-ucic" name="questions[${qIdx}][options][3]" placeholder="Teks Pilihan D">
                        </div>
                    </div>
                </div>
            </div>
        `;

        container.insertAdjacentHTML('beforeend', cardHtml);
        reindexQuestionTitles();
    });

    // Dynamic Delete Question Card
    document.getElementById('questionsContainer').addEventListener('click', function (e) {
        if (e.target.closest('.btn-delete-question')) {
            const card = e.target.closest('.question-card-item');
            if (document.querySelectorAll('.question-card-item').length > 1) {
                card.remove();
                reindexQuestionTitles();
            } else {
                alert('Minimal harus terdapat 1 soal dalam ujian.');
            }
        }
    });

    function reindexQuestionTitles() {
        document.querySelectorAll('.question-card-item').forEach((item, index) => {
            const titleEl = item.querySelector('.question-title-text');
            if (titleEl) titleEl.textContent = `Soal #${index + 1}`;
        });
    }

    // Image Preview Feature
    document.addEventListener('change', function(e) {
        if (e.target.matches('input[type="file"][accept="image/*"]')) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(evt) {
                    // Find or create preview container
                    let container = e.target.closest('.col-md-9').querySelector('.image-preview-container');
                    if (!container) {
                        container = document.createElement('div');
                        container.className = 'image-preview-container mb-2 mt-2';
                        e.target.parentNode.insertBefore(container, e.target);
                    }
                    container.innerHTML = `<img src="${evt.target.result}" alt="Preview" class="img-thumbnail border border-primary shadow-sm" style="max-height: 150px;">`;
                    
                    // Hide existing image container if any
                    const existingImg = e.target.closest('.col-md-9').querySelector('.existing-image-container');
                    if(existingImg) existingImg.style.display = 'none';
                }
                reader.readAsDataURL(file);
            }
        }
    });
});
</script>
@endpush
