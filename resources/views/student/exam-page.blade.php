@extends('layouts.app')

@section('title', 'CBT Exam Interface - Universitas Catur Insan Cendekia')

@section('content')
<!-- TOP CBT HEADER -->
<header class="cbt-header">
    <div class="container-fluid px-md-4">
        <div class="d-flex align-items-center justify-content-between">
            
            <!-- Left: Logo & Exam Title -->
            <div class="d-flex align-items-center gap-3">
                <img src="{{ asset('images/logo-ucic.png') }}" alt="UCIC Logo" class="ucic-logo-img-sm">
                <div class="d-none d-md-block border-start ps-3">
                    <h6 class="fw-bold text-ucic-primary m-0" style="font-size: 0.95rem; line-height: 1.2;">CBT PMB UCIC 2026/2027</h6>
                    <small class="text-muted" style="font-size: 0.78rem;">Tes Potensi Akademik & Bahasa Inggris</small>
                </div>
            </div>

            <!-- Center: Auto Save Status -->
            <div class="d-none d-lg-flex align-items-center">
                <div class="auto-save-indicator bg-light px-3 py-1.5 rounded-pill border">
                    <span class="auto-save-dot"></span>
                    <span id="autoSaveText">Tersimpan otomatis 11:20:05</span>
                </div>
            </div>

            <!-- Right: Timer & Mobile Sidebar Toggle -->
            <div class="d-flex align-items-center gap-3">
                <div class="cbt-timer" id="cbtTimerDisplay">
                    <i class="bi bi-clock-history"></i>
                    <span>01:29:55</span>
                </div>
                <button class="btn btn-outline-primary d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#cbtSidebarOffcanvas">
                    <i class="bi bi-grid-3x3-gap-fill fs-5"></i>
                </button>
            </div>
        </div>
    </div>
</header>

<!-- MAIN EXAM LAYOUT -->
<div class="container-fluid px-md-4 my-4 flex-grow-1">
    <div class="row g-4">
        
        <!-- LEFT / MAIN QUESTION PANEL -->
        <div class="col-lg-8 col-xl-9">
            <div class="ucic-card h-100 d-flex flex-column">
                
                <!-- Question Card Header -->
                <div class="ucic-card-header d-flex align-items-center justify-content-between bg-light">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-ucic-primary px-3 py-2 fs-6 rounded-pill" id="currentQuestionTitle">Soal No. 1</span>
                        <span class="text-muted small">dari 50 Soal</span>
                    </div>

                    <button type="button" class="btn btn-sm btn-outline-warning fw-semibold px-3 rounded-pill" id="btnFlagQuestion">
                        <i class="bi bi-flag-fill me-1"></i> Ragu-ragu
                    </button>
                </div>

                <!-- Question Text Body -->
                <div class="ucic-card-body flex-grow-1 p-4 p-md-5">
                    <div class="question-text mb-4" style="font-size: 1.1rem; line-height: 1.7; color: #1E293B;">
                        <p class="fw-medium mb-3">
                            Manakah di antara pernyataan berikut yang paling tepat mengenai prinsip dasar pengembangan sistem informasi berbasis jaringan komputer di lingkungan perguruan tinggi?
                        </p>
                        <p class="text-secondary small mb-0">
                            Pilihlah salah satu jawaban yang menurut Anda paling benar di bawah ini:
                        </p>
                    </div>

                    <!-- ANSWER OPTIONS (A, B, C, D, E) -->
                    <div class="options-container space-y-3">
                        
                        <!-- Option A -->
                        <label class="option-card mb-3 w-100">
                            <input type="radio" name="question_1" value="A" class="d-none">
                            <div class="option-key">A</div>
                            <div class="option-text">
                                Mengutamakan skabilitas, keamanan data, dan integrasi antar layanan akademik secara terpusat.
                            </div>
                        </label>

                        <!-- Option B -->
                        <label class="option-card mb-3 w-100">
                            <input type="radio" name="question_1" value="B" class="d-none">
                            <div class="option-key">B</div>
                            <div class="option-text">
                                Membatasi akses seluruh mahasiswa agar data tidak dapat diakses dari luar kampus.
                            </div>
                        </label>

                        <!-- Option C -->
                        <label class="option-card mb-3 w-100">
                            <input type="radio" name="question_1" value="C" class="d-none">
                            <div class="option-key">C</div>
                            <div class="option-text">
                                Menggunakan perangkat keras dengan spesifikasi paling sederhana tanpa enkripsi data.
                            </div>
                        </label>

                        <!-- Option D -->
                        <label class="option-card mb-3 w-100">
                            <input type="radio" name="question_1" value="D" class="d-none">
                            <div class="option-key">D</div>
                            <div class="option-text">
                                Menghilangkan peran server pusat dan menggantikannya dengan sistem manual.
                            </div>
                        </label>

                        <!-- Option E -->
                        <label class="option-card mb-3 w-100">
                            <input type="radio" name="question_1" value="E" class="d-none">
                            <div class="option-key">E</div>
                            <div class="option-text">
                                Menyimpan seluruh cadangan data hanya pada media fisik flashdisk lokal.
                            </div>
                        </label>

                    </div>
                </div>

                <!-- Bottom Question Navigation Toolbar -->
                <div class="p-3 p-md-4 border-top bg-light d-flex align-items-center justify-content-between rounded-bottom-4">
                    <button class="btn btn-outline-secondary px-4 py-2 fw-semibold rounded-3" disabled>
                        <i class="bi bi-chevron-left me-1"></i> Sebelumnya
                    </button>

                    <div class="d-flex align-items-center gap-2">
                        <button class="btn btn-ucic-secondary px-4 py-2 fw-semibold rounded-3">
                            <span>Selanjutnya</span> <i class="bi bi-chevron-right ms-1"></i>
                        </button>

                        <button class="btn btn-success px-4 py-2 fw-semibold rounded-3" data-bs-toggle="modal" data-bs-target="#finishModal">
                            <i class="bi bi-check-circle-fill me-1"></i> Selesai Ujian
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT QUESTION NAVIGATION SIDEBAR (Desktop) -->
        <div class="col-lg-4 col-xl-3 d-none d-lg-block">
            <div class="ucic-card h-100">
                <div class="ucic-card-header bg-ucic-primary text-white" style="border-radius: 18px 18px 0 0;">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-white text-ucic-primary fw-bold d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                            <i class="bi bi-person-fill fs-5"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold m-0" style="font-size: 0.95rem;">Ahmad Fauzi</h6>
                            <small class="text-white-50" style="font-size: 0.75rem;">SMAN 1 Cirebon</small>
                        </div>
                    </div>
                </div>

                <div class="ucic-card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6 class="fw-bold m-0 text-dark">Navigasi Soal</h6>
                        <small class="badge bg-light text-muted border">50 Soal</small>
                    </div>

                    <!-- Question Grid 1 - 20 preview -->
                    <div class="cbt-num-grid mb-4">
                        <div class="cbt-num-btn active answered" data-index="1">1</div>
                        <div class="cbt-num-btn answered" data-index="2">2</div>
                        <div class="cbt-num-btn answered" data-index="3">3</div>
                        <div class="cbt-num-btn flagged" data-index="4">4</div>
                        <div class="cbt-num-btn" data-index="5">5</div>
                        <div class="cbt-num-btn" data-index="6">6</div>
                        <div class="cbt-num-btn answered" data-index="7">7</div>
                        <div class="cbt-num-btn" data-index="8">8</div>
                        <div class="cbt-num-btn" data-index="9">9</div>
                        <div class="cbt-num-btn" data-index="10">10</div>
                        <div class="cbt-num-btn" data-index="11">11</div>
                        <div class="cbt-num-btn" data-index="12">12</div>
                        <div class="cbt-num-btn" data-index="13">13</div>
                        <div class="cbt-num-btn" data-index="14">14</div>
                        <div class="cbt-num-btn" data-index="15">15</div>
                        <div class="cbt-num-btn" data-index="16">16</div>
                        <div class="cbt-num-btn" data-index="17">17</div>
                        <div class="cbt-num-btn" data-index="18">18</div>
                        <div class="cbt-num-btn" data-index="19">19</div>
                        <div class="cbt-num-btn" data-index="20">20</div>
                    </div>

                    <!-- Legend -->
                    <div class="border-top pt-3 space-y-2" style="font-size: 0.82rem;">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="d-flex align-items-center gap-2">
                                <span class="legend-dot answered"></span> Sudah Dijawab
                            </span>
                            <strong class="text-ucic-primary">4 Soal</strong>
                        </div>

                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="d-flex align-items-center gap-2">
                                <span class="legend-dot flagged"></span> Ragu-ragu
                            </span>
                            <strong class="text-warning">1 Soal</strong>
                        </div>

                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="d-flex align-items-center gap-2">
                                <span class="legend-dot unanswered"></span> Belum Dijawab
                            </span>
                            <strong class="text-muted">45 Soal</strong>
                        </div>

                        <div class="d-flex align-items-center justify-content-between">
                            <span class="d-flex align-items-center gap-2">
                                <span class="legend-dot active"></span> Posisi Soal Aktif
                            </span>
                            <strong class="text-dark">No. 1</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- FINISH EXAM CONFIRMATION MODAL -->
<div class="modal fade" id="finishModal" tabindex="-1" aria-labelledby="finishModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-body p-4 p-md-5 text-center">
                <div class="stat-icon primary mx-auto mb-3" style="width: 64px; height: 64px; font-size: 2rem;">
                    <i class="bi bi-question-circle-fill"></i>
                </div>
                <h4 class="fw-bold mb-2">Konfirmasi Selesai Ujian</h4>
                <p class="text-secondary mb-4 small" style="line-height: 1.6;">
                    Apakah Anda yakin ingin menyelesaikan ujian ini? Pastikan seluruh soal telah dijawab dengan teliti sebelum mengirimkan jawaban.
                </p>

                <div class="row g-2 mb-4 text-start bg-light p-3 rounded-3" style="font-size: 0.88rem;">
                    <div class="col-6">Sudah Dijawab: <strong class="text-success">4 Soal</strong></div>
                    <div class="col-6">Ragu-ragu: <strong class="text-warning">1 Soal</strong></div>
                    <div class="col-6">Belum Dijawab: <strong class="text-danger">45 Soal</strong></div>
                    <div class="col-6">Sisa Waktu: <strong class="text-primary">01:29:55</strong></div>
                </div>

                <div class="d-flex gap-3">
                    <button type="button" class="btn btn-light w-50 py-2.5 fw-semibold" data-bs-dismiss="modal">Kembali ke Soal</button>
                    <a href="{{ url('/student/thank-you') }}" class="btn btn-ucic-primary w-50 py-2.5 fw-semibold">
                        Ya, Kirim Jawaban
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
