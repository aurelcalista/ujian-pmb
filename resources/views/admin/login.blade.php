@extends('layouts.app')

@section('title', 'Admin Login - CBT PMB UCIC')

@section('content')
<div class="container my-5 flex-grow-1 d-flex align-items-center justify-content-center">
    <div class="row justify-content-center w-100">
        <div class="col-lg-5 col-md-7">
            
            <div class="ucic-card p-4 p-md-5">
                <div class="text-center mb-4">
                    <img src="{{ asset('images/logo-ucic.png') }}" alt="UCIC Logo" class="mb-3" style="height: 56px;">
                    <h4 class="fw-extrabold text-ucic-primary m-0">Administrator Login</h4>
                    <p class="text-muted small mt-1">CBT Seleksi PMB Universitas Catur Insan Cendekia</p>
                </div>

                <form action="{{ url('/admin/dashboard') }}" method="GET">
                    
                    <!-- Email -->
                    <div class="mb-3">
                        <label for="adminEmail" class="form-label-ucic">Alamat Email Administrator</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted border-end-0" style="border-radius: 12px 0 0 12px;">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input type="email" class="form-control form-control-ucic border-start-0" id="adminEmail" name="email" value="admin@cic.ac.id" placeholder="admin@cic.ac.id" required style="border-radius: 0 12px 12px 0;">
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="adminPassword" class="form-label-ucic">Kata Sandi (Password)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted border-end-0" style="border-radius: 12px 0 0 12px;">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input type="password" class="form-control form-control-ucic border-start-0" id="adminPassword" name="password" value="••••••••••••" placeholder="••••••••••••" required style="border-radius: 0 12px 12px 0;">
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="d-flex align-items-center justify-content-between mb-4" style="font-size: 0.85rem;">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rememberMe" checked>
                            <label class="form-check-label text-muted" for="rememberMe">
                                Ingat Saya
                            </label>
                        </div>
                        <a href="#" class="text-ucic-secondary fw-semibold text-decoration-none" onclick="alert('Silakan hubungi tim IT Administrator UCIC untuk reset kata sandi.'); return false;">Lupa Password?</a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-ucic-primary w-100 py-3 fs-6 d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-box-arrow-in-right fs-5"></i>
                        <span>Masuk Administrator</span>
                    </button>
                </form>

                <div class="mt-4 pt-3 border-top text-center">
                    <a href="{{ url('/') }}" class="text-muted small text-decoration-none">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Halaman Utama Peserta
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
