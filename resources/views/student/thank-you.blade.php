@extends('layouts.app')

@section('title', 'Terima Kasih - CBT PMB UCIC')

@section('content')
<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg ucic-navbar">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-3" href="{{ url('/') }}">
            <img src="{{ asset('images/logo-ucic.png') }}" alt="UCIC Logo" class="ucic-logo-img">
        </a>
    </div>
</nav>

<!-- MAIN CONTENT CONTAINER -->
<div class="container my-5 flex-grow-1 d-flex align-items-center justify-content-center">
    <div class="row justify-content-center w-100">
        <div class="col-lg-6 col-md-8 text-center">
            
            <div class="ucic-card p-4 p-md-5">
                
                <!-- SUCCESS ICON ANIMATION -->
                <div class="mx-auto mb-4 d-flex align-items-center justify-content-center rounded-circle bg-success-subtle text-success" style="width: 100px; height: 100px; box-shadow: 0 10px 25px rgba(16, 185, 129, 0.2);">
                    <i class="bi bi-check-circle-fill" style="font-size: 4.5rem; line-height: 1;"></i>
                </div>

                <!-- TITLE & CONFIRMATION TEXT -->
                <h2 class="fw-extrabold text-dark mb-2" style="letter-spacing: -0.5px;">Terima Kasih</h2>
                <h5 class="fw-semibold text-ucic-primary mb-3">Jawaban Anda berhasil dikirim.</h5>

                <p class="text-secondary mb-4" style="line-height: 1.7; font-size: 0.98rem; max-width: 480px; margin: 0 auto;">
                    Hasil seleksi ujian penerimaan mahasiswa baru akan diumumkan secara resmi oleh <strong>Panitia PMB Universitas Catur Insan Cendekia</strong> melalui website dan kontak pendaftaran Anda.
                </p>

                <!-- NOTICE BANNER -->
                <div class="alert alert-primary bg-ucic-light border-0 text-ucic-primary p-3 rounded-4 mb-4 small text-center">
                    <i class="bi bi-info-circle-fill me-1"></i> Silakan pantau pengumuman terbaru di website resmi UCIC.
                </div>

                <!-- ACTION BUTTON -->
                <a href="{{ url('/') }}" class="btn btn-ucic-primary btn-lg px-5 py-3 fs-6 d-inline-flex align-items-center gap-2">
                    <i class="bi bi-house-door-fill fs-5"></i>
                    <span>Selesai</span>
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
