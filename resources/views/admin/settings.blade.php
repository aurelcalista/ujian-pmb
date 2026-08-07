@extends('layouts.admin')

@section('title', 'Pengaturan Sistem - Admin CBT UCIC')
@section('page_heading', 'Pengaturan Sistem CBT')

@section('admin_content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        
        <div class="ucic-card">
            <div class="ucic-card-header bg-light">
                <h6 class="fw-bold m-0 text-dark">Pengaturan Konfigurasi Ujian PMB</h6>
                <small class="text-muted" style="font-size: 0.78rem;">Atur durasi, jumlah soal, status ujian, dan identitas universitas</small>
            </div>

            <div class="ucic-card-body p-4 p-md-5">
                <form action="#" onsubmit="alert('Pengaturan sistem berhasil disimpan!'); return false;">
                    
                    <!-- University Logo Preview Section -->
                    <div class="mb-4 pb-4 border-bottom">
                        <label class="form-label-ucic d-block">Logo Resmi Universitas</label>
                        <div class="d-flex align-items-center gap-4 mt-2">
                            <div class="p-3 bg-light border rounded-3 text-center">
                                <img src="{{ asset('images/logo-ucic.png') }}" alt="UCIC Logo Preview" style="height: 60px; width: auto;">
                            </div>
                            <div>
                                <button type="button" class="btn btn-sm btn-outline-primary mb-1" onclick="alert('Pilih file logo baru (PNG / SVG max 2MB).');">
                                    <i class="bi bi-upload me-1"></i> Unggah Logo Baru
                                </button>
                                <small class="text-muted d-block" style="font-size: 0.75rem;">Format disarankan: PNG Transparan atau SVG. Ukuran ideal: 400x120px.</small>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4 mb-4">
                        <!-- Tahun Akademik -->
                        <div class="col-md-6">
                            <label for="academicYear" class="form-label-ucic">Tahun Akademik PMB</label>
                            <input type="text" class="form-control form-control-ucic" id="academicYear" value="2026/2027">
                        </div>

                        <!-- Status Ujian Toggle -->
                        <div class="col-md-6">
                            <label for="examStatus" class="form-label-ucic">Status Akses Ujian Peserta</label>
                            <select class="form-select form-select-ucic" id="examStatus">
                                <option value="active" selected>Aktif (Dapat Diakses Peserta)</option>
                                <option value="inactive">Non-Aktif (Ujian Ditutup)</option>
                            </select>
                        </div>

                        <!-- Durasi Ujian -->
                        <div class="col-md-6">
                            <label for="examDuration" class="form-label-ucic">Durasi Pengerjaan Ujian (Menit)</label>
                            <div class="input-group">
                                <input type="number" class="form-control form-control-ucic border-end-0" id="examDuration" value="90">
                                <span class="input-group-text bg-light text-muted border-start-0" style="border-radius: 0 12px 12px 0;">Menit</span>
                            </div>
                        </div>

                        <!-- Jumlah Soal -->
                        <div class="col-md-6">
                            <label for="totalQuestions" class="form-label-ucic">Jumlah Soal per Peserta</label>
                            <div class="input-group">
                                <input type="number" class="form-control form-control-ucic border-end-0" id="totalQuestions" value="50">
                                <span class="input-group-text bg-light text-muted border-start-0" style="border-radius: 0 12px 12px 0;">Soal</span>
                            </div>
                        </div>
                    </div>

                    <!-- Additional System Options -->
                    <div class="mb-4 pb-3 border-bottom">
                        <label class="form-label-ucic mb-2">Opsi Keamanan & Pengerjaan</label>
                        
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="shuffleQuestions" checked>
                            <label class="form-check-label text-dark" for="shuffleQuestions">
                                Acak urutan soal untuk setiap peserta (Randomize Questions)
                            </label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="shuffleOptions" checked>
                            <label class="form-check-label text-dark" for="shuffleOptions">
                                Acak urutan opsi pilihan jawaban (Randomize Options A-E)
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="autoSubmit" checked>
                            <label class="form-check-label text-dark" for="autoSubmit">
                                Kirim jawaban otomatis ketika timer waktu ujian habis
                            </label>
                        </div>
                    </div>

                    <!-- Save Action -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-ucic-primary btn-lg px-5 py-2.5 fs-6">
                            <i class="bi bi-save2-fill me-2"></i> Simpan Pengaturan
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection
