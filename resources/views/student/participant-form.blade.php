@extends('layouts.app')

@section('title', 'Form Data Peserta - CBT PMB UCIC')

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
<div class="container my-5 flex-grow-1 d-flex align-items-center justify-content-center">
    <div class="row justify-content-center w-100">
        <div class="col-lg-10 col-xl-9">
            <div class="ucic-card">
                <div class="ucic-card-header text-center bg-ucic-primary text-white position-relative overflow-hidden" style="border-radius: 18px 18px 0 0; background: linear-gradient(135deg, #005BAC 0%, #004685 100%);">
                    <div class="py-2 position-relative" style="z-index: 2;">
                        <h4 class="fw-bold mb-1">Form Data Peserta Ujian</h4>
                        <p class="text-white-50 small m-0">Silakan isi data diri Anda dengan benar sebelum memulai ujian CBT.</p>
                    </div>
                </div>

                <div class="ucic-card-body p-4 p-md-5">
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
                        
                        <div class="row g-3 mb-4">
                            <!-- Nama Lengkap -->
                            <div class="col-md-4">
                                <label for="fullName" class="form-label-ucic">
                                    Nama Lengkap <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted border-end-0" style="border-radius: 12px 0 0 12px;">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    <input type="text" class="form-control form-control-ucic border-start-0" id="fullName" name="fullName" placeholder="Masukkan nama" required style="border-radius: 0 12px 12px 0;">
                                    <div class="invalid-feedback">Nama lengkap wajib diisi.</div>
                                </div>
                            </div>

                            <!-- Asal Sekolah -->
                            <div class="col-md-4">
                                <label for="schoolOrigin" class="form-label-ucic">
                                    Asal Sekolah <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted border-end-0" style="border-radius: 12px 0 0 12px;">
                                        <i class="bi bi-building-check"></i>
                                    </span>
                                    <input type="text" class="form-control form-control-ucic border-start-0" id="schoolOrigin" name="schoolOrigin" placeholder="Asal SMA/SMK" required style="border-radius: 0 12px 12px 0;">
                                    <div class="invalid-feedback">Asal sekolah wajib diisi.</div>
                                </div>
                            </div>

                            <!-- Pilihan Program Studi -->
                            <div class="col-md-4">
                                <label for="prodi1" class="form-label-ucic">
                                    Pilihan Prodi <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted border-end-0" style="border-radius: 12px 0 0 12px;">
                                        <i class="bi bi-journal-bookmark-fill text-ucic-primary"></i>
                                    </span>
                                    <select class="form-select form-select-ucic border-start-0" id="prodi1" name="majorChoice1" required style="border-radius: 0 12px 12px 0;">
                                        <option value="" selected disabled>Pilih Prodi</option>
                                        @foreach($studyPrograms as $prodi)
                                            <option value="{{ $prodi->name }}">{{ $prodi->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Pilih program studi.</div>
                                </div>
                            </div>
                        </div>


                        <!-- Action Button -->
                        <button type="submit" class="btn btn-ucic-primary w-100 py-3 fs-6 fw-bold d-flex align-items-center justify-content-center gap-2">
                            <span>Mulai Ujian Sekarang</span>
                            <i class="bi bi-play-circle-fill fs-5"></i>
                        </button>
                    </form>
                </div>
            </div>
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
