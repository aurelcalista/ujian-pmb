@extends('layouts.admin')

@section('title', 'Pengaturan Sistem - Admin CBT UCIC')
@section('page_heading', 'Pengaturan Sistem CBT')

@section('admin_content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="ucic-card">
            <div class="ucic-card-header bg-light">
                <h6 class="fw-bold m-0 text-dark">Pengaturan Konfigurasi Ujian PMB</h6>
                <small class="text-muted" style="font-size: 0.78rem;">Atur durasi, batas pelanggaran anti-cheat, dan opsi pengerjaan</small>
            </div>

            <div class="ucic-card-body p-4 p-md-5">
                <form action="{{ url('/admin/settings') }}" method="POST">
                    @csrf

                    <!-- University Logo Preview Section -->
                    <div class="mb-4 pb-4 border-bottom">
                        <label class="form-label-ucic d-block">Logo Resmi Universitas</label>
                        <div class="d-flex align-items-center gap-4 mt-2">
                            <div class="p-3 bg-light border rounded-3 text-center">
                                <img src="{{ asset('images/logo-ucic.png') }}" alt="UCIC Logo Preview" style="height: 60px; width: auto;">
                            </div>
                            <div>
                                <button type="button" class="btn btn-sm btn-outline-primary mb-1" onclick="alert('Logo saat ini menggunakan aset resmi UCIC CBT.');">
                                    <i class="bi bi-shield-check me-1"></i> Logo UCIC Resmi Aktif
                                </button>
                                <small class="text-muted d-block" style="font-size: 0.75rem;">Aset logo tersimpan pada folder public/images/logo-ucic.png.</small>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4 mb-4">
                        <!-- Status Ujian Toggle -->
                        <div class="col-md-12">
                            <label for="examStatus" class="form-label-ucic">Status Akses Ujian Peserta</label>
                            <select class="form-select form-select-ucic" id="examStatus" name="status">
                                <option value="active" {{ ($exam->status ?? 'active') === 'active' ? 'selected' : '' }}>Aktif (Dapat Diakses Peserta)</option>
                                <option value="draft" {{ ($exam->status ?? '') === 'draft' ? 'selected' : '' }}>Draft (Persiapan)</option>
                                <option value="finished" {{ ($exam->status ?? '') === 'finished' ? 'selected' : '' }}>Non-Aktif (Selesai/Ditutup)</option>
                            </select>
                        </div>
                        
                        <!-- Waktu Mulai -->
                        <div class="col-md-4">
                            <label for="start_time" class="form-label-ucic">Waktu Mulai <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control form-control-ucic" id="start_time" name="start_time" value="{{ $exam && $exam->start_time ? $exam->start_time->format('Y-m-d\TH:i') : '' }}" required>
                        </div>

                        <!-- Waktu Selesai -->
                        <div class="col-md-4">
                            <label for="end_time" class="form-label-ucic">Waktu Selesai <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control form-control-ucic" id="end_time" name="end_time" value="{{ $exam && $exam->end_time ? $exam->end_time->format('Y-m-d\TH:i') : '' }}" required>
                        </div>

                        <!-- Durasi Ujian -->
                        <div class="col-md-4">
                            <label for="examDuration" class="form-label-ucic">Durasi (Menit)</label>
                            <div class="input-group">
                                <input type="number" class="form-control form-control-ucic border-end-0" id="examDuration" name="duration" value="{{ $exam->duration ?? 90 }}" min="10" max="300" required>
                                <span class="input-group-text bg-light text-muted border-start-0" style="border-radius: 0 12px 12px 0;">Menit</span>
                            </div>
                        </div>

                        <!-- Maksimal Pelanggaran -->
                        <div class="col-md-6">
                            <label for="maxViolation" class="form-label-ucic">Maksimal Toleransi Pelanggaran (Batas Warning)</label>
                            <div class="input-group">
                                <input type="number" class="form-control form-control-ucic border-end-0" id="maxViolation" name="max_violation" value="{{ $exam->max_violation ?? 3 }}" min="1" max="10" required>
                                <span class="input-group-text bg-light text-muted border-start-0" style="border-radius: 0 12px 12px 0;">Kali</span>
                            </div>
                        </div>
                    </div>

                    <!-- Additional System Options -->
                    <div class="mb-4 pb-3 border-bottom">
                        <label class="form-label-ucic mb-2">Opsi Keamanan & Pengerjaan Ujian</label>
                        
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="shuffleQuestions" name="shuffle_questions" value="1" {{ ($exam->shuffle_questions ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label text-dark" for="shuffleQuestions">
                                Acak urutan soal untuk setiap peserta (Randomize Questions)
                            </label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="shuffleOptions" name="shuffle_options" value="1" {{ ($exam->shuffle_options ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label text-dark" for="shuffleOptions">
                                Acak urutan opsi pilihan jawaban (Randomize Options A-E)
                            </label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="fullscreenEnabled" name="fullscreen_enabled" value="1" {{ ($exam->fullscreen_enabled ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label text-dark" for="fullscreenEnabled">
                                Wajibkan Mode Layar Penuh Browser (Fullscreen Mode)
                            </label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="autosaveEnabled" name="autosave_enabled" value="1" {{ ($exam->autosave_enabled ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label text-dark" for="autosaveEnabled">
                                Aktifkan Penyimpanan Otomatis Jawaban Real-time (Auto Save AJAX)
                            </label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="antiCheatEnabled" name="anti_cheat_enabled" value="1" {{ ($exam->anti_cheat_enabled ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label text-dark" for="antiCheatEnabled">
                                Aktifkan Sistem Anti-Cheat (Exambro Style Tab & Focus Detector)
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
