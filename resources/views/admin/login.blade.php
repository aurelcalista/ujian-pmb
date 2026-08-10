@extends('layouts.app')

@section('title', 'Admin Login - CBT PMB UCIC')

@push('styles')
<style>
.admin-login-wrapper {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
    background-color: var(--ucic-bg, #F7FAFF);
    box-sizing: border-box;
}

.admin-login-card {
    width: 100%;
    max-width: 570px;
    background-color: #FFFFFF;
    border: 1px solid #E2E8F0;
    border-radius: 16px;
    box-shadow: 0 10px 25px -5px rgba(0, 91, 172, 0.05), 0 8px 10px -6px rgba(0, 91, 172, 0.03);
    padding: 36px 40px 32px 40px;
    margin: 0 auto;
    box-sizing: border-box;
}

.admin-login-logo {
    width: 130px;
    height: auto;
    object-fit: contain;
    display: block;
    margin: 0 auto 18px auto;
}

.admin-login-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--ucic-primary, #005BAC);
    margin-bottom: 6px;
    line-height: 1.25;
}

.admin-login-subtitle {
    font-size: 0.875rem;
    color: var(--ucic-text-muted, #64748B);
    margin-bottom: 0;
    line-height: 1.4;
}

.admin-login-header {
    margin-bottom: 32px;
}

.admin-form-group-email {
    margin-bottom: 22px;
}

.admin-form-group-password {
    margin-bottom: 20px;
}

.admin-login-label {
    font-size: 0.875rem;
    font-weight: 500;
    color: #334155;
    margin-bottom: 8px;
    display: block;
}

.admin-input-group {
    height: 48px;
}

.admin-input-group .input-group-text {
    background-color: #F8FAFC;
    border: 1px solid #E2E8F0;
    border-end: 0;
    border-radius: 10px 0 0 10px;
    color: #94A3B8;
    padding: 0 16px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.admin-input-group .form-control {
    height: 48px;
    border: 1px solid #E2E8F0;
    border-start: 0;
    border-radius: 0 10px 10px 0;
    font-size: 0.9375rem;
    color: #1E293B;
    background-color: #FFFFFF;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.admin-input-group .form-control:focus {
    border-color: var(--ucic-primary, #005BAC);
    box-shadow: 0 0 0 3.5px rgba(0, 91, 172, 0.15);
    outline: none;
}

.admin-input-group:focus-within .input-group-text {
    border-color: var(--ucic-primary, #005BAC);
    color: var(--ucic-primary, #005BAC);
}

.admin-remember-row {
    margin-bottom: 30px;
    font-size: 0.875rem;
}

.admin-forgot-link {
    color: var(--ucic-primary, #005BAC);
    font-weight: 500;
    text-decoration: none;
    transition: color 0.2s ease;
}

.admin-forgot-link:hover {
    color: var(--ucic-primary-hover, #004685);
    text-decoration: underline;
}

.btn-admin-submit {
    width: 100%;
    height: 50px;
    background-color: var(--ucic-primary, #005BAC) !important;
    color: #FFFFFF !important;
    font-weight: 600;
    font-size: 0.95rem;
    border-radius: 10px;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
}

.btn-admin-submit:hover,
.btn-admin-submit:focus {
    background-color: var(--ucic-primary-hover, #004685) !important;
    color: #FFFFFF !important;
    box-shadow: 0 6px 18px rgba(0, 91, 172, 0.25);
    transform: translateY(-1px);
}

.btn-admin-submit:active {
    transform: translateY(0);
    box-shadow: none;
}

.admin-login-divider {
    border: 0;
    border-top: 1px solid #E5E7EB;
    margin: 30px 0 22px 0;
    opacity: 1;
}

.admin-back-link {
    color: #475569;
    font-size: 0.875rem;
    font-weight: 500;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: color 0.2s ease-in-out;
}

.admin-back-link:hover {
    color: var(--ucic-primary, #005BAC);
}

@media (max-width: 575.98px) {
    .admin-login-wrapper {
        padding: 1.25rem 0.75rem;
    }

    .admin-login-card {
        padding: 24px 20px 20px 20px;
        border-radius: 14px;
        margin: 0 8px;
        max-width: calc(100% - 16px);
    }

    .admin-login-logo {
        width: 120px;
        margin-bottom: 14px;
    }

    .admin-login-title {
        font-size: 1.35rem;
    }

    .admin-login-header {
        margin-bottom: 26px;
    }
}
</style>
@endpush

@section('content')
<div class="admin-login-wrapper">
    <div class="admin-login-card">
        
        <!-- Header: Logo, Title & Subtitle -->
        <div class="text-center admin-login-header">
            <img src="{{ asset('images/logo-ucic.png') }}" alt="UCIC Logo" class="admin-login-logo">
            <h4 class="admin-login-title">Administrator Login</h4>
            <p class="admin-login-subtitle">CBT Seleksi PMB Universitas Catur Insan Cendekia</p>
        </div>

        <!-- Form Login -->
        <form action="{{ url('/admin/login') }}" method="POST">
            @csrf

            @if($errors->any())
                <div class="alert alert-danger p-3 rounded-3 small mb-3">
                    <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ $errors->first() }}
                </div>
            @endif
            
            <!-- Email -->
            <div class="admin-form-group-email">
                <label for="adminEmail" class="admin-login-label">Alamat Email Administrator</label>
                <div class="input-group admin-input-group">
                    <span class="input-group-text">
                        <i class="bi bi-envelope fs-5"></i>
                    </span>
                    <input type="email" class="form-control" id="adminEmail" name="email" value="admin@cic.ac.id" placeholder="admin@cic.ac.id" required>
                </div>
            </div>

            <!-- Password -->
            <div class="admin-form-group-password">
                <label for="adminPassword" class="admin-login-label">Kata Sandi (Password)</label>
                <div class="input-group admin-input-group">
                    <span class="input-group-text">
                        <i class="bi bi-lock fs-5"></i>
                    </span>
                    <input type="password" class="form-control" id="adminPassword" name="password" value="••••••••••••" placeholder="••••••••••••" required>
                </div>
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="d-flex align-items-center justify-content-between admin-remember-row">
                <div class="form-check m-0 d-flex align-items-center gap-2">
                    <input class="form-check-input mt-0" type="checkbox" id="rememberMe" checked style="width: 18px; height: 18px; cursor: pointer;">
                    <label class="form-check-label text-muted" for="rememberMe" style="cursor: pointer;">
                        Ingat Saya
                    </label>
                </div>
                <a href="#" class="admin-forgot-link" onclick="alert('Silakan hubungi tim IT Administrator UCIC untuk reset kata sandi.'); return false;">Lupa Password?</a>
            </div>

            <!-- Submit Button (Primary Action) -->
            <button type="submit" class="btn btn-admin-submit">
                <i class="bi bi-box-arrow-in-right fs-5"></i>
                <span>Masuk Administrator</span>
            </button>
        </form>

        <!-- Divider -->
        <hr class="admin-login-divider">

        <!-- Back Link -->
        <div class="text-center">
            <a href="{{ url('/') }}" class="admin-back-link">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Halaman Utama Peserta
            </a>
        </div>
    </div>
</div>
@endsection


