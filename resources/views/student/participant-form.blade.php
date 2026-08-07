@extends('layouts.app')

@section('title', 'Form Data Peserta - CBT PMB UCIC')

@section('content')
<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg ucic-navbar">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-3" href="{{ url('/') }}">
            <img src="{{ asset('images/logo-ucic.png') }}" alt="UCIC Logo" class="ucic-logo-img">
        </a>
        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-ucic-light text-ucic-primary fw-semibold px-3 py-2 rounded-pill">
                <i class="bi bi-person-vcard me-1"></i> Form Biodata Ujian
            </span>
        </div>
    </div>
</nav>

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
                    <form action="{{ url('/student/info') }}" method="GET" class="needs-validation" novalidate>
                        
                        <!-- Nama Lengkap -->
                        <div class="mb-4">
                            <label for="fullName" class="form-label-ucic">
                                Nama Lengkap <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0" style="border-radius: 12px 0 0 12px;">
                                    <i class="bi bi-person"></i>
                                </span>
                                <input type="text" class="form-control form-control-ucic border-start-0" id="fullName" name="full_name" placeholder="Masukkan nama lengkap sesuai ijazah" required style="border-radius: 0 12px 12px 0;">
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
                                <input type="text" class="form-control form-control-ucic border-start-0" id="schoolOrigin" name="school_origin" placeholder="Contoh: SMAN 1 Cirebon" required style="border-radius: 0 12px 12px 0;">
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
                                <select class="form-select form-select-ucic border-start-0" id="prodi1" name="prodi_1" required style="border-radius: 0 12px 12px 0;">
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
                                <select class="form-select form-select-ucic border-start-0" id="prodi2" name="prodi_2" required style="border-radius: 0 12px 12px 0;">
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
