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
        <div class="col-lg-7 col-md-9">
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
                        
                        <!-- Nama Lengkap -->
                        <div class="mb-4">
                            <label for="fullName" class="form-label-ucic">
                                Nama Lengkap <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0" style="border-radius: 12px 0 0 12px;">
                                    <i class="bi bi-person"></i>
                                </span>
                                <input type="text" class="form-control form-control-ucic border-start-0" id="fullName" name="fullName" placeholder="Masukkan nama lengkap sesuai ijazah" required style="border-radius: 0 12px 12px 0;">
                                <div class="invalid-feedback">Nama lengkap wajib diisi.</div>
                            </div>
                        </div>

                        <!-- Asal Sekolah -->
                        <div class="mb-4">
                            <label for="schoolOrigin" class="form-label-ucic">
                                Asal Sekolah (SMA / SMK / MA) <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0" style="border-radius: 12px 0 0 12px;">
                                    <i class="bi bi-building-check"></i>
                                </span>
                                <input type="text" class="form-control form-control-ucic border-start-0" id="schoolOrigin" name="schoolOrigin" placeholder="Contoh: SMAN 1 Cirebon" required style="border-radius: 0 12px 12px 0;">
                                <div class="invalid-feedback">Asal sekolah wajib diisi.</div>
                            </div>
                        </div>

                        <!-- Pilihan Program Studi 1 -->
                        <div class="mb-4">
                            <label for="prodi1" class="form-label-ucic">
                                Pilihan Program Studi 1 <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0" style="border-radius: 12px 0 0 12px;">
                                    <i class="bi bi-journal-bookmark-fill text-ucic-primary"></i>
                                </span>
                                <select class="form-select form-select-ucic border-start-0" id="prodi1" name="majorChoice1" required style="border-radius: 0 12px 12px 0;">
                                    <option value="" selected disabled>-- Pilih Program Studi 1 --</option>
                                    <option value="S1 Teknik Informatika">S1 - Teknik Informatika</option>
                                    <option value="S1 Sistem Informasi">S1 - Sistem Informasi</option>
                                    <option value="S1 Desain Komunikasi Visual">S1 - Desain Komunikasi Visual</option>
                                    <option value="S1 Manajemen">S1 - Manajemen</option>
                                    <option value="S1 Akuntansi">S1 - Akuntansi</option>
                                    <option value="D3 Manajemen Informatika">D3 - Manajemen Informatika</option>
                                    <option value="D3 Komputerisasi Akuntansi">D3 - Komputerisasi Akuntansi</option>
                                </select>
                                <div class="invalid-feedback">Pilih program studi pilihan ke-1.</div>
                            </div>
                        </div>

                        <!-- Pilihan Program Studi 2 -->
                        <div class="mb-4">
                            <label for="prodi2" class="form-label-ucic">
                                Pilihan Program Studi 2 <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0" style="border-radius: 12px 0 0 12px;">
                                    <i class="bi bi-journal-bookmark text-ucic-secondary"></i>
                                </span>
                                <select class="form-select form-select-ucic border-start-0" id="prodi2" name="majorChoice2" required style="border-radius: 0 12px 12px 0;">
                                    <option value="" selected disabled>-- Pilih Program Studi 2 --</option>
                                    <option value="S1 Teknik Informatika">S1 - Teknik Informatika</option>
                                    <option value="S1 Sistem Informasi">S1 - Sistem Informasi</option>
                                    <option value="S1 Desain Komunikasi Visual">S1 - Desain Komunikasi Visual</option>
                                    <option value="S1 Manajemen">S1 - Manajemen</option>
                                    <option value="S1 Akuntansi">S1 - Akuntansi</option>
                                    <option value="D3 Manajemen Informatika">D3 - Manajemen Informatika</option>
                                    <option value="D3 Komputerisasi Akuntansi">D3 - Komputerisasi Akuntansi</option>
                                </select>
                                <div class="invalid-feedback">Pilih program studi pilihan ke-2.</div>
                            </div>
                        </div>

                        <!-- Info Banner -->
                        <div class="alert alert-primary d-flex align-items-center gap-3 rounded-3 border-0 bg-ucic-light text-ucic-primary mb-4" role="alert">
                            <i class="bi bi-info-circle-fill fs-4 flex-shrink-0"></i>
                            <div class="small">
                                Pastikan data yang dimasukkan sudah benar. Setelah tombol diklik, Anda akan diarahkan ke halaman petunjuk ujian.
                            </div>
                        </div>

                        <!-- Action Button -->
                        <button type="submit" class="btn btn-ucic-primary w-100 py-3 fs-6 d-flex align-items-center justify-content-center gap-2">
                            <span>Lanjut ke Petunjuk Ujian</span>
                            <i class="bi bi-arrow-right-circle-fill fs-5"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FOOTER -->
<footer class="bg-white border-top py-3 py-md-4 mt-auto position-relative" style="z-index: 10;">
    <div class="container">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between text-center text-md-start gap-3">
            <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-3 flex-wrap flex-sm-nowrap">
                <img src="{{ asset('images/logo-ucic.png') }}" alt="UCIC Logo" style="height: 36px; width: auto; object-fit: contain;">
                <div>
                    <strong class="d-block text-ucic-primary" style="font-size: 0.92rem;">Universitas Catur Insan Cendekia (UCIC)</strong>
                    <small class="text-muted d-block" style="font-size: 0.76rem;">Sistem Computer Based Test (CBT) Penerimaan Mahasiswa Baru</small>
                </div>
            </div>
            <div class="text-center text-md-end">
                <span class="text-muted small" style="font-size: 0.78rem;">&copy; {{ date('Y') }} PMB UCIC. All Rights Reserved.</span>
            </div>
        </div>
    </div>
</footer>

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
