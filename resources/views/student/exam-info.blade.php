@extends('layouts.app')

@section('title', 'Informasi & Petunjuk Ujian - CBT PMB UCIC')

@section('content')
<!-- STICKY FLOATING PILL NAVBAR WITH MOBILE HAMBURGER -->
<header class="ucic-floating-navbar-wrapper mb-3">
    <div class="container d-flex flex-column align-items-center px-2 px-sm-3">
        <div class="ucic-floating-navbar d-flex align-items-center justify-content-between gap-2 gap-md-3">
            <a href="{{ url('/') }}" class="d-flex align-items-center gap-2 gap-md-3 text-decoration-none">
                <img src="{{ asset('images/logo-ucic.png') }}" alt="UCIC Logo" class="navbar-logo-img">
                <div class="d-flex flex-column text-start border-start ps-2.5 ps-md-3">
                    <span class="nav-brand-title" style="font-size: 0.92rem; font-weight: 700; color: var(--ucic-primary); line-height: 1.2;">Computer Based Test PMB</span>
                    <span class="nav-brand-subtitle d-none d-sm-block" style="font-size: 0.72rem; color: var(--ucic-text-muted); line-height: 1.2;">Universitas Catur Insan Cendekia</span>
                </div>
            </a>
            <div class="d-none d-md-flex align-items-center gap-1">
                <a href="{{ url('/') }}" class="btn btn-pill-nav">Beranda</a>
                <a href="{{ url('/student/form') }}" class="btn btn-pill-nav active">Petunjuk Ujian</a>
            </div>
            <button class="btn btn-pill-hamburger d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#mobilePillMenuInfo" aria-expanded="false">
                <i class="bi bi-list fs-4"></i>
            </button>
        </div>
        <div class="collapse w-100 d-md-none" id="mobilePillMenuInfo" style="max-width: 960px;">
            <div class="ucic-mobile-pill-menu d-flex flex-column gap-2 text-center">
                <a href="{{ url('/') }}" class="btn btn-pill-nav py-2.5">
                    <i class="bi bi-house-door-fill me-1"></i> Beranda
                </a>
                <a href="{{ url('/student/form') }}" class="btn btn-pill-nav active py-2.5">
                    <i class="bi bi-journal-text me-1"></i> Petunjuk Ujian
                </a>
            </div>
        </div>
    </div>
</header>

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
                                    <h6 class="fw-bold m-0 text-ucic-primary">{{ $exam->duration ?? 90 }} Menit</h6>
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
                                    <h6 class="fw-bold m-0 text-ucic-secondary">{{ $questionsCount ?? 50 }} Soal</h6>
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
                                <h6 class="fw-bold mb-1">Peringatan Anti-Cheat & Tata Tertib</h6>
                                <p class="small mb-0 text-secondary">
                                    Selama ujian berlangsung: <strong>Jangan membuka tab lain, jangan keluar dari fullscreen, dan jangan berpindah browser tab.</strong> Semua aktivitas pelanggaran akan dicatat otomatis.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Status Messages -->
                    @if(session('error'))
                        <div class="alert alert-danger border-0 text-dark p-3 rounded-4 mb-4">
                            <i class="bi bi-x-circle-fill text-danger me-2"></i> {{ session('error') }}
                        </div>
                    @endif

                    @if(!$isExamStarted)
                        <div class="alert alert-info border-0 text-dark p-3 rounded-4 mb-4">
                            <i class="bi bi-info-circle-fill text-info me-2"></i> Ujian belum dimulai. Ujian akan dimulai pada <strong>{{ $exam->start_time ? \Carbon\Carbon::parse($exam->start_time)->translatedFormat('d F Y H:i') : '-' }}</strong>.
                        </div>
                    @endif

                    @if($isExamEnded)
                        <div class="alert alert-danger border-0 text-dark p-3 rounded-4 mb-4">
                            <i class="bi bi-x-circle-fill text-danger me-2"></i> Ujian telah berakhir pada <strong>{{ $exam->end_time ? \Carbon\Carbon::parse($exam->end_time)->translatedFormat('d F Y H:i') : '-' }}</strong>. Anda tidak dapat memulai ujian.
                        </div>
                    @endif

                    <!-- Confirm CTA -->
                    <div class="text-center pt-2">
                        <form action="{{ url('/student/start') }}" method="POST">
                            @csrf
                            @if(!$isExamStarted || $isExamEnded)
                                <button type="button" class="btn btn-secondary btn-lg px-5 py-3 fs-6 d-inline-flex align-items-center gap-2" disabled>
                                    <i class="bi bi-lock-fill fs-5"></i>
                                    <span>Belum Tersedia</span>
                                </button>
                            @else
                                <button type="submit" class="btn btn-ucic-primary btn-lg px-5 py-3 fs-6 d-inline-flex align-items-center gap-2">
                                    <i class="bi bi-play-circle-fill fs-5"></i>
                                    <span>Mulai Ujian Sekarang</span>
                                </button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
