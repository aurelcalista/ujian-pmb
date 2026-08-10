@extends('layouts.app')

@section('title', 'Form Data Peserta - CBT PMB UCIC')

@push('styles')
<style>
.participant-form-wrapper {
    min-height: calc(100vh - 120px);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
    box-sizing: border-box;
}

.participant-form-card {
    width: 100%;
    max-width: 780px;
    background: #FFFFFF;
    border: 1px solid #E2E8F0;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0, 91, 172, 0.06), 0 4px 12px rgba(0, 0, 0, 0.03);
    overflow: hidden;
    margin: 0 auto;
}

.participant-card-header {
    background: linear-gradient(135deg, #005BAC 0%, #004685 100%);
    padding: 24px 28px 20px 28px;
    text-align: center;
    color: #FFFFFF;
}

.participant-card-header h4 {
    font-size: 1.35rem;
    font-weight: 700;
    margin-bottom: 4px;
}

.participant-card-header p {
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.88);
    margin: 0;
    line-height: 1.4;
}

.participant-card-body {
    padding: 36px 40px;
}

.form-group-item {
    margin-bottom: 20px;
}

.form-group-item:last-of-type {
    margin-bottom: 26px;
}

.form-label-custom {
    font-size: 0.875rem;
    font-weight: 500;
    color: #334155;
    margin-bottom: 8px;
    display: block;
}

.input-group-custom {
    height: 48px;
}

.input-group-custom .input-group-text {
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

.input-group-custom .form-control,
.input-group-custom .form-select {
    height: 48px;
    border: 1px solid #E2E8F0;
    border-start: 0;
    border-radius: 0 10px 10px 0;
    font-size: 0.9375rem;
    color: #1E293B;
    background-color: #FFFFFF;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.input-group-custom .form-control:focus,
.input-group-custom .form-select:focus {
    border-color: #005BAC;
    box-shadow: 0 0 0 3.5px rgba(0, 91, 172, 0.15);
    outline: none;
}

.input-group-custom:focus-within .input-group-text {
    border-color: #005BAC;
    color: #005BAC;
}

.btn-start-exam {
    width: 100%;
    height: 50px;
    background-color: #005BAC !important;
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

.btn-start-exam:hover,
.btn-start-exam:focus {
    background-color: #004685 !important;
    color: #FFFFFF !important;
    box-shadow: 0 6px 18px rgba(0, 91, 172, 0.25);
    transform: translateY(-1px);
}

.btn-start-exam:active {
    transform: translateY(0);
    box-shadow: none;
}

@media (max-width: 991.98px) {
    .participant-form-card {
        width: 90%;
        max-width: 760px;
    }
}

@media (max-width: 575.98px) {
    .participant-form-wrapper {
        padding: 1.25rem 0.75rem;
    }

    .participant-form-card {
        width: calc(100% - 16px);
        margin: 0 8px;
        border-radius: 14px;
    }

    .participant-card-header {
        padding: 20px 16px 16px 16px;
    }

    .participant-card-header h4 {
        font-size: 1.2rem;
    }

    .participant-card-body {
        padding: 24px 20px;
    }
}
</style>
@endpush

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
                <a href="{{ url('/student/form') }}" class="btn btn-pill-nav active">Form Ujian</a>
            </div>
            <button class="btn btn-pill-hamburger d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#mobilePillMenuForm" aria-expanded="false">
                <i class="bi bi-list fs-4"></i>
            </button>
        </div>
        <div class="collapse w-100 d-md-none" id="mobilePillMenuForm" style="max-width: 960px;">
            <div class="ucic-mobile-pill-menu d-flex flex-column gap-2 text-center">
                <a href="{{ url('/') }}" class="btn btn-pill-nav py-2.5">
                    <i class="bi bi-house-door-fill me-1"></i> Beranda
                </a>
                <a href="{{ url('/student/form') }}" class="btn btn-pill-nav active py-2.5">
                    <i class="bi bi-journal-text me-1"></i> Form Ujian
                </a>
            </div>
        </div>
    </div>
</header>

<!-- MAIN FORM CONTAINER -->
<div class="participant-form-wrapper">
    <div class="participant-form-card">
        <!-- Header Biru Compact -->
        <div class="participant-card-header">
            <h4>Form Data Peserta Ujian</h4>
            <p>Silakan isi data diri Anda dengan benar sebelum memulai ujian CBT.</p>
        </div>

        <!-- Form Body Compact Vertikal -->
        <div class="participant-card-body">
            <form action="{{ url('/student/form') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                
                @if($errors->any())
                    <div class="alert alert-danger shadow-sm border-0 rounded-3 d-flex align-items-center gap-3 mb-4">
                        <i class="bi bi-x-circle-fill fs-3 flex-shrink-0"></i>
                        <div>
                            <strong>Gagal Masuk Ujian!</strong><br>
                            @foreach($errors->all() as $error)
                                <span class="small">{{ $error }}</span><br>
                            @endforeach
                        </div>
                    </div>
                @endif
                
                <!-- Nama Lengkap -->
                <div class="form-group-item">
                    <label for="fullName" class="form-label-custom">
                        Nama Lengkap <span class="text-danger">*</span>
                    </label>
                    <div class="input-group input-group-custom">
                        <span class="input-group-text">
                            <i class="bi bi-person fs-5"></i>
                        </span>
                        <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Masukkan nama" required>
                        <div class="invalid-feedback">Nama lengkap wajib diisi.</div>
                    </div>
                </div>

                <!-- Asal Sekolah -->
                <div class="form-group-item">
                    <label for="schoolOrigin" class="form-label-custom">
                        Asal Sekolah <span class="text-danger">*</span>
                    </label>
                    <div class="input-group input-group-custom">
                        <span class="input-group-text">
                            <i class="bi bi-building-check fs-5"></i>
                        </span>
                        <input type="text" class="form-control" id="schoolOrigin" name="schoolOrigin" placeholder="Asal SMA/SMK" required>
                        <div class="invalid-feedback">Asal sekolah wajib diisi.</div>
                    </div>
                </div>

                <!-- Pilihan Program Studi -->
                <div class="form-group-item">
                    <label for="prodi1" class="form-label-custom">
                        Pilihan Program Studi <span class="text-danger">*</span>
                    </label>
                    <div class="input-group input-group-custom">
                        <span class="input-group-text">
                            <i class="bi bi-journal-bookmark-fill text-ucic-primary fs-5"></i>
                        </span>
                        <select class="form-select" id="prodi1" name="majorChoice1" required>
                            <option value="" selected disabled>Pilih Prodi</option>
                            @foreach($studyPrograms as $prodi)
                                <option value="{{ $prodi->name }}">{{ $prodi->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Pilih program studi.</div>
                    </div>
                </div>

                <!-- Action Button -->
                <button type="submit" class="btn btn-start-exam">
                    <i class="bi bi-play-circle-fill fs-5"></i>
                    <span>Mulai Ujian Sekarang</span>
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Form validation handling
(function () {
  'use strict'
  var forms = document.querySelectorAll('.needs-validation')
  Array.prototype.slice.call(forms).forEach(function (form) {
    form.addEventListener('submit', function (event) {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }
      form.classList.add('was-validated')
    }, false)
  })
})()
</script>
@endpush
@endsection

