@extends('layouts.app')

@section('title', 'Informasi & Petunjuk Ujian - CBT PMB UCIC')

@section('content')
<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg ucic-navbar">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-3" href="{{ url('/') }}">
            <img src="{{ asset('images/logo-ucic.png') }}" alt="UCIC Logo" class="ucic-logo-img">
        </a>
        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-ucic-light text-ucic-primary fw-semibold px-3 py-2 rounded-pill">
                <i class="bi bi-shield-check me-1"></i> Konfirmasi Ujian
            </span>
        </div>
    </div>
</nav>

<!-- MAIN CONTAINER -->
<div class="container my-5 flex-grow-1">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            
            <!-- Exam Info Card Header -->
            <div class="ucic-card mb-4 overflow-hidden">
                <div class="p-4 p-md-5 bg-ucic-primary text-white position-relative" style="background: linear-gradient(135deg, #005BAC 0%, #2F80ED 100%);">
                    <div class="row align-items-center">
                        <div class="col-md-8 mb-3 mb-md-0">
                            <span class="badge bg-warning text-dark fw-bold mb-2 px-3 py-1">Ujian Masuk UCIC 2026/2027</span>
                            <h3 class="fw-extrabold m-0">Tes Potensi Akademik & Bahasa Inggris</h3>
                            <p class="text-white-50 mt-2 mb-0">Seleksi Penerimaan Mahasiswa Baru Universitas Catur Insan Cendekia</p>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <div class="bg-white text-dark p-3 rounded-4 shadow-sm d-inline-block text-center" style="min-width: 160px;">
                                <div class="text-muted small fw-semibold">STATUS UJIAN</div>
                                <div class="badge bg-success px-3 py-2 mt-1 fs-6">Siap Dimulai</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Metric Cards Grid -->
                <div class="p-4 bg-light border-bottom">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="bg-white p-3 rounded-3 border d-flex align-items-center gap-3">
                                <div class="stat-icon primary" style="width: 48px; height: 48px; font-size: 1.3rem;">
                                    <i class="bi bi-clock-history"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block" style="font-size: 0.78rem;">Durasi Ujian</small>
                                    <h6 class="fw-bold m-0 text-ucic-primary">90 Menit</h6>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="bg-white p-3 rounded-3 border d-flex align-items-center gap-3">
                                <div class="stat-icon secondary" style="width: 48px; height: 48px; font-size: 1.3rem;">
                                    <i class="bi bi-file-earmark-check"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block" style="font-size: 0.78rem;">Jumlah Soal</small>
                                    <h6 class="fw-bold m-0 text-ucic-secondary">50 Soal</h6>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="bg-white p-3 rounded-3 border d-flex align-items-center gap-3">
                                <div class="stat-icon accent" style="width: 48px; height: 48px; font-size: 1.3rem;">
                                    <i class="bi bi-ui-checks"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block" style="font-size: 0.78rem;">Tipe Pengerjaan</small>
                                    <h6 class="fw-bold m-0 text-dark">Pilihan Ganda</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Instructions Body -->
                <div class="ucic-card-body p-4 p-md-5">
                    <h5 class="fw-bold mb-3 text-ucic-primary">
                        <i class="bi bi-list-check me-2"></i>Petunjuk Pengerjaan Ujian
                    </h5>

                    <ol class="space-y-3 mb-4 text-secondary" style="line-height: 1.8; font-size: 0.95rem;">
                        <li>Bacalah setiap soal dengan teliti sebelum memilih jawaban yang dianggap paling tepat.</li>
                        <li>Pilihlah salah satu jawaban (A, B, C, D, atau E) dengan mengklik pada kartu opsi jawaban.</li>
                        <li>Sistem secara otomatis akan menyimpan jawaban Anda setiap kali opsi dipilih (Real-time Auto Save).</li>
                        <li>Anda dapat mengubah jawaban selama waktu ujian masih berlangsung.</li>
                        <li>Gunakan tombol <strong>"Ragu-ragu"</strong> jika Anda belum yakin dengan jawaban yang dipilih.</li>
                        <li>Waktu pengerjaan akan dihitung mundur secara otomatis oleh timer di bagian atas layar.</li>
                        <li>Jika waktu habis, sistem akan secara otomatis mengumpulkan semua jawaban Anda.</li>
                    </ol>

                    <!-- Warning Box -->
                    <div class="alert alert-warning border-0 bg-warning-subtle text-dark p-4 rounded-4 mb-4">
                        <div class="d-flex gap-3">
                            <i class="bi bi-exclamation-triangle-fill fs-3 text-warning"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Peringatan Tata Tertib Ujian</h6>
                                <p class="small mb-0 text-secondary">
                                    Peserta dilarang membuka tab baru, mencari bantuan dari luar, atau menutup halaman browser selama ujian berlangsung. Pelanggaran tata tertib dapat mengakibatkan pembatalan hasil seleksi PMB.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Confirm CTA -->
                    <div class="text-center pt-2">
                        <a href="{{ url('/student/exam') }}" class="btn btn-ucic-primary btn-lg px-5 py-3 fs-6 d-inline-flex align-items-center gap-2">
                            <i class="bi bi-play-circle-fill fs-5"></i>
                            <span>Mulai Ujian Sekarang</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
