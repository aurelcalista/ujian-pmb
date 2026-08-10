@extends('layouts.app')

@section('title', 'Ujian Diblokir - CBT PMB UCIC')

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
                <a href="{{ url('/') }}" class="btn btn-pill-nav active">Beranda</a>
            </div>
            <button class="btn btn-pill-hamburger d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#mobilePillMenuThanks" aria-expanded="false">
                <i class="bi bi-list fs-4"></i>
            </button>
        </div>
        <div class="collapse w-100 d-md-none" id="mobilePillMenuThanks" style="max-width: 960px;">
            <div class="ucic-mobile-pill-menu d-flex flex-column gap-2 text-center">
                <a href="{{ url('/') }}" class="btn btn-pill-nav active py-2.5">
                    <i class="bi bi-house-door-fill me-1"></i> Beranda
                </a>
            </div>
        </div>
    </div>
</header>

<!-- MAIN CONTENT CONTAINER -->
<div class="container my-5 flex-grow-1 d-flex align-items-center justify-content-center">
    <div class="row justify-content-center w-100">
        <div class="col-lg-6 col-md-8 text-center">
            
            <div class="ucic-card p-4 p-md-5 border-danger border border-2">
                
                <!-- ERROR ICON ANIMATION -->
                <div class="mx-auto mb-4 d-flex align-items-center justify-content-center rounded-circle bg-danger-subtle text-danger" style="width: 100px; height: 100px; box-shadow: 0 10px 25px rgba(220, 38, 38, 0.2);">
                    <i class="bi bi-exclamation-triangle-fill" style="font-size: 4.5rem; line-height: 1;"></i>
                </div>

                <!-- TITLE & CONFIRMATION TEXT -->
                <h2 class="fw-extrabold text-danger mb-2" style="letter-spacing: -0.5px;">Ujian Dihentikan Paksa</h2>
                <h5 class="fw-semibold text-dark mb-3">Anda telah mencapai batas maksimal pelanggaran sistem.</h5>

                <p class="text-secondary mb-4" style="line-height: 1.7; font-size: 0.98rem; max-width: 480px; margin: 0 auto;">
                    Sistem mendeteksi adanya aktivitas mencurigakan yang berulang (seperti berpindah tab aplikasi atau keluar dari layar penuh). Ujian Anda otomatis ditutup dan disubmit ke Admin.
                </p>

                <!-- NOTICE BANNER -->
                <div class="alert alert-danger border-0 p-3 rounded-4 mb-4 small text-center" style="background-color: #fef2f2;">
                    <i class="bi bi-shield-lock-fill me-1"></i> <strong>Anda tidak dapat melanjutkan atau mengulang ujian ini.</strong><br>
                    Silakan hubungi Administrator PMB Universitas Catur Insan Cendekia untuk meminta izin ujian ulang atau menjelaskan kendala Anda.
                </div>

                <!-- ACTION BUTTON -->
                <a href="{{ url('/') }}" class="btn btn-danger btn-lg px-5 py-3 fs-6 d-inline-flex align-items-center gap-2">
                    <i class="bi bi-house-door-fill fs-5"></i>
                    <span>Kembali ke Beranda</span>
                </a>
            </div>

        </div>
    </div>
</div>

<!-- FOOTER -->
<footer class="bg-white border-top py-3 py-md-4 mt-auto position-relative" style="z-index: 10;">
    <div class="container">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between text-center text-md-start gap-3">
            <div class="d-flex flex-column flex-sm-row align-items-center justify-content-center justify-content-md-start gap-3.5 gap-md-4 text-center text-sm-start">
                <img src="{{ asset('images/logo-ucic-footer.png') }}" alt="UCIC Logo Emblem" class="footer-logo-img" style="height: 58px; width: auto; object-fit: contain;">
                <div>
                    <strong class="d-block text-ucic-primary" style="font-size: 0.95rem;">Universitas Catur Insan Cendekia (UCIC)</strong>
                    <small class="text-muted d-block" style="font-size: 0.78rem;">Sistem Computer Based Test (CBT) Penerimaan Mahasiswa Baru</small>
                </div>
            </div>
            <div class="text-center text-md-end">
                <span class="text-muted small" style="font-size: 0.78rem;">&copy; {{ date('Y') }} PMB UCIC. All Rights Reserved.</span>
            </div>
        </div>
    </div>
</footer>
@endsection
