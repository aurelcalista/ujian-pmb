@extends('layouts.admin')

@section('title', 'Hasil Ujian PMB - Admin CBT UCIC')
@section('page_heading', 'Hasil Ujian & Rekapitulasi Nilai')

@section('admin_content')
<div class="ucic-card">
    <div class="ucic-card-header">
        <div class="row align-items-center g-3">
            <div class="col-md-6">
                <h6 class="fw-bold m-0 text-dark">Laporan Hasil Seleksi CBT PMB</h6>
                <small class="text-muted" style="font-size: 0.78rem;">Data nilai lengkap per peserta (Hanya dapat diakses oleh Administrator)</small>
            </div>
            <div class="col-md-6">
                <div class="d-flex align-items-center gap-2 justify-content-md-end">
                    <!-- Export Excel Button -->
                    <button class="btn btn-outline-success btn-sm px-3 rounded-3" onclick="alert('Mengunduh Laporan Hasil Ujian dalam format Excel (.xlsx)...');">
                        <i class="bi bi-file-earmark-excel me-1"></i> Export Excel
                    </button>

                    <!-- Export PDF Button -->
                    <button class="btn btn-outline-danger btn-sm px-3 rounded-3" onclick="alert('Mengunduh Laporan Rekapitulasi Nilai dalam format PDF...');">
                        <i class="bi bi-file-earmark-pdf me-1"></i> Export PDF
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-ucic align-middle mb-0">
            <thead>
                <tr>
                    <th>Peserta</th>
                    <th>Asal Sekolah</th>
                    <th>Pilihan Prodi 1 & 2</th>
                    <th class="text-center">Benar</th>
                    <th class="text-center">Salah</th>
                    <th class="text-center">Nilai Akhir</th>
                    <th>Waktu Selesai</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="fw-bold text-dark">Ahmad Fauzi</div>
                        <small class="text-muted">PMB-2026-001</small>
                    </td>
                    <td>SMAN 1 Cirebon</td>
                    <td>
                        <div class="small fw-semibold text-ucic-primary">1. S1 Teknik Informatika</div>
                        <div class="small text-muted">2. S1 Sistem Informasi</div>
                    </td>
                    <td class="text-center text-success fw-bold">45</td>
                    <td class="text-center text-danger fw-semibold">5</td>
                    <td class="text-center">
                        <span class="badge bg-success px-3 py-2 fs-6 rounded-pill">90.0</span>
                    </td>
                    <td class="text-muted small">07 Aug 2026, 11:15</td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-ucic-outline" onclick="alert('Detail Lembar Jawaban Peserta: Ahmad Fauzi\nJawaban Benar: 45\nJawaban Salah: 5\nNilai: 90.0');">
                            <i class="bi bi-file-text me-1"></i> Detail
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="fw-bold text-dark">Citra Kirana</div>
                        <small class="text-muted">PMB-2026-003</small>
                    </td>
                    <td>SMA BPK Penabur</td>
                    <td>
                        <div class="small fw-semibold text-ucic-primary">1. S1 DKV</div>
                        <div class="small text-muted">2. S1 Manajemen</div>
                    </td>
                    <td class="text-center text-success fw-bold">42</td>
                    <td class="text-center text-danger fw-semibold">8</td>
                    <td class="text-center">
                        <span class="badge bg-success px-3 py-2 fs-6 rounded-pill">84.0</span>
                    </td>
                    <td class="text-muted small">07 Aug 2026, 10:45</td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-ucic-outline"><i class="bi bi-file-text me-1"></i> Detail</button>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="fw-bold text-dark">Dewi Sartika</div>
                        <small class="text-muted">PMB-2026-004</small>
                    </td>
                    <td>SMA Al-Azhar Cirebon</td>
                    <td>
                        <div class="small fw-semibold text-ucic-primary">1. S1 Manajemen</div>
                        <div class="small text-muted">2. S1 Akuntansi</div>
                    </td>
                    <td class="text-center text-success fw-bold">39</td>
                    <td class="text-center text-danger fw-semibold">11</td>
                    <td class="text-center">
                        <span class="badge bg-primary px-3 py-2 fs-6 rounded-pill">78.0</span>
                    </td>
                    <td class="text-muted small">07 Aug 2026, 10:30</td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-ucic-outline"><i class="bi bi-file-text me-1"></i> Detail</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
