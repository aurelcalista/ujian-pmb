@extends('layouts.admin')

@section('title', 'Dashboard Administrator - CBT PMB UCIC')
@section('page_heading', 'Dashboard Overview')

@section('admin_content')
<!-- STATS CARDS GRID -->
<div class="row g-3 mb-4">
    
    <!-- Stat 1: Total Participants -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div>
                <small class="text-muted fw-semibold d-block" style="font-size: 0.8rem;">TOTAL PESERTA</small>
                <h3 class="fw-extrabold m-0 text-dark mt-1">1,248</h3>
                <small class="text-success fw-medium" style="font-size: 0.75rem;">
                    <i class="bi bi-graph-up-arrow me-1"></i> +12% dari minggu lalu
                </small>
            </div>
            <div class="stat-icon primary">
                <i class="bi bi-people-fill"></i>
            </div>
        </div>
    </div>

    <!-- Stat 2: Completed Exams -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div>
                <small class="text-muted fw-semibold d-block" style="font-size: 0.8rem;">UJIAN SELESAI</small>
                <h3 class="fw-extrabold m-0 text-dark mt-1">1,120</h3>
                <small class="text-success fw-medium" style="font-size: 0.75rem;">
                    <i class="bi bi-check-circle-fill me-1"></i> 89.7% Tingkat Selesai
                </small>
            </div>
            <div class="stat-icon success">
                <i class="bi bi-clipboard2-check-fill"></i>
            </div>
        </div>
    </div>

    <!-- Stat 3: Total Questions -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div>
                <small class="text-muted fw-semibold d-block" style="font-size: 0.8rem;">TOTAL BANK SOAL</small>
                <h3 class="fw-extrabold m-0 text-dark mt-1">150</h3>
                <small class="text-muted fw-medium" style="font-size: 0.75rem;">
                    3 Kategori Mata Uji
                </small>
            </div>
            <div class="stat-icon secondary">
                <i class="bi bi-journal-text"></i>
            </div>
        </div>
    </div>

    <!-- Stat 4: Average Score -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div>
                <small class="text-muted fw-semibold d-block" style="font-size: 0.8rem;">RATA-RATA NILAI</small>
                <h3 class="fw-extrabold m-0 text-dark mt-1">82.4</h3>
                <small class="text-ucic-primary fw-medium" style="font-size: 0.75rem;">
                    Skor Tertinggi: 98.0
                </small>
            </div>
            <div class="stat-icon accent">
                <i class="bi bi-award-fill"></i>
            </div>
        </div>
    </div>

</div>

<!-- CHART & RECENT ACTIVITY SECTION -->
<div class="row g-4 mb-4">
    <!-- Line Chart -->
    <div class="col-lg-8">
        <div class="ucic-card h-100">
            <div class="ucic-card-header d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="fw-bold m-0 text-dark">Grafik Kehadiran & Penyelesaian Ujian</h6>
                    <small class="text-muted" style="font-size: 0.78rem;">Tren partisipasi peserta per hari dalam 7 hari terakhir</small>
                </div>
                <span class="badge bg-ucic-light text-ucic-primary px-3 py-1.5 rounded-pill">Minggu Ini</span>
            </div>
            <div class="ucic-card-body">
                <div style="height: 320px; position: relative;">
                    <canvas id="participantChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Distribution Card -->
    <div class="col-lg-4">
        <div class="ucic-card h-100">
            <div class="ucic-card-header">
                <h6 class="fw-bold m-0 text-dark">Distribusi Pilihan Prodi</h6>
                <small class="text-muted" style="font-size: 0.78rem;">Persentase minat program studi pilihan 1</small>
            </div>
            <div class="ucic-card-body">
                <div class="space-y-4">
                    <div>
                        <div class="d-flex justify-content-between mb-1 small fw-semibold">
                            <span>S1 Teknik Informatika</span>
                            <span class="text-ucic-primary">38% (474)</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-ucic-primary" style="width: 38%;"></div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="d-flex justify-content-between mb-1 small fw-semibold">
                            <span>S1 Sistem Informasi</span>
                            <span class="text-ucic-secondary">25% (312)</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-ucic-secondary" style="width: 25%;"></div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="d-flex justify-content-between mb-1 small fw-semibold">
                            <span>S1 Desain Komunikasi Visual</span>
                            <span class="text-info">18% (225)</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-info" style="width: 18%;"></div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="d-flex justify-content-between mb-1 small fw-semibold">
                            <span>S1 Manajemen</span>
                            <span class="text-warning">12% (150)</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-warning" style="width: 12%;"></div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="d-flex justify-content-between mb-1 small fw-semibold">
                            <span>Lainnya (Akuntansi & D3)</span>
                            <span class="text-secondary">7% (87)</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-secondary" style="width: 7%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- RECENT PARTICIPANTS TABLE -->
<div class="ucic-card">
    <div class="ucic-card-header d-flex align-items-center justify-content-between">
        <div>
            <h6 class="fw-bold m-0 text-dark">Peserta Ujian Terbaru</h6>
            <small class="text-muted" style="font-size: 0.78rem;">Daftar aktivitas pengerjaan ujian real-time</small>
        </div>
        <a href="{{ url('/admin/participants') }}" class="btn btn-sm btn-ucic-outline">Lihat Semua Peserta</a>
    </div>
    <div class="table-responsive">
        <table class="table table-ucic align-middle mb-0">
            <thead>
                <tr>
                    <th>Nama Peserta</th>
                    <th>Asal Sekolah</th>
                    <th>Pilihan Prodi 1</th>
                    <th>Pilihan Prodi 2</th>
                    <th>Status Ujian</th>
                    <th>Waktu Selesai</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="fw-semibold">Ahmad Fauzi</div>
                        <small class="text-muted">ID: PMB-2026-001</small>
                    </td>
                    <td>SMAN 1 Cirebon</td>
                    <td><span class="badge bg-ucic-light text-ucic-primary">S1 Teknik Informatika</span></td>
                    <td><span class="badge bg-light text-dark">S1 Sistem Informasi</span></td>
                    <td><span class="badge-ucic-success"><i class="bi bi-check-circle me-1"></i>Selesai</span></td>
                    <td class="text-muted small">07 Aug 2026, 11:15</td>
                </tr>
                <tr>
                    <td>
                        <div class="fw-semibold">Bintang Pratama</div>
                        <small class="text-muted">ID: PMB-2026-002</small>
                    </td>
                    <td>SMKN 1 Cirebon</td>
                    <td><span class="badge bg-ucic-light text-ucic-primary">S1 Sistem Informasi</span></td>
                    <td><span class="badge bg-light text-dark">S1 DKV</span></td>
                    <td><span class="badge-ucic-warning"><i class="bi bi-clock-history me-1"></i>Sedang Mengerjakan</span></td>
                    <td class="text-muted small">-</td>
                </tr>
                <tr>
                    <td>
                        <div class="fw-semibold">Citra Kirana</div>
                        <small class="text-muted">ID: PMB-2026-003</small>
                    </td>
                    <td>SMA BPK Penabur</td>
                    <td><span class="badge bg-ucic-light text-ucic-primary">S1 DKV</span></td>
                    <td><span class="badge bg-light text-dark">S1 Manajemen</span></td>
                    <td><span class="badge-ucic-success"><i class="bi bi-check-circle me-1"></i>Selesai</span></td>
                    <td class="text-muted small">07 Aug 2026, 10:45</td>
                </tr>
                <tr>
                    <td>
                        <div class="fw-semibold">Dewi Sartika</div>
                        <small class="text-muted">ID: PMB-2026-004</small>
                    </td>
                    <td>SMA Al-Azhar Cirebon</td>
                    <td><span class="badge bg-ucic-light text-ucic-primary">S1 Manajemen</span></td>
                    <td><span class="badge bg-light text-dark">S1 Akuntansi</span></td>
                    <td><span class="badge-ucic-success"><i class="bi bi-check-circle me-1"></i>Selesai</span></td>
                    <td class="text-muted small">07 Aug 2026, 10:30</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
