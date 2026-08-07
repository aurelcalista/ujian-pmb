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
                <h3 class="fw-extrabold m-0 text-dark mt-1">{{ number_format($totalParticipantsCount) }}</h3>
                <small class="text-success fw-medium" style="font-size: 0.75rem;">
                    <i class="bi bi-person-check-fill me-1"></i> Peserta Terdaftar
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
                <h3 class="fw-extrabold m-0 text-dark mt-1">{{ number_format($completedParticipantsCount) }}</h3>
                <small class="text-success fw-medium" style="font-size: 0.75rem;">
                    <i class="bi bi-check-circle-fill me-1"></i> {{ $totalParticipantsCount > 0 ? round(($completedParticipantsCount / $totalParticipantsCount) * 100, 1) : 0 }}% Tingkat Selesai
                </small>
            </div>
            <div class="stat-icon success">
                <i class="bi bi-clipboard2-check-fill"></i>
            </div>
        </div>
    </div>

    <!-- Stat 3: Violations Detected -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div>
                <small class="text-muted fw-semibold d-block" style="font-size: 0.8rem;">TERINDIKASI PELANGGARAN</small>
                <h3 class="fw-extrabold m-0 text-dark mt-1">{{ number_format($violatingParticipantsCount) }}</h3>
                <small class="text-danger fw-medium" style="font-size: 0.75rem;">
                    <i class="bi bi-exclamation-triangle-fill me-1"></i> Perlu Review Admin
                </small>
            </div>
            <div class="stat-icon accent" style="background-color: #FEE2E2; color: #DC2626;">
                <i class="bi bi-shield-exclamation"></i>
            </div>
        </div>
    </div>

    <!-- Stat 4: Average Score -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div>
                <small class="text-muted fw-semibold d-block" style="font-size: 0.8rem;">RATA-RATA NILAI</small>
                <h3 class="fw-extrabold m-0 text-dark mt-1">{{ number_format($avgScore, 1) }}</h3>
                <small class="text-ucic-primary fw-medium" style="font-size: 0.75rem;">
                    Skor Tertinggi: {{ number_format($highestScore, 1) }}
                </small>
            </div>
            <div class="stat-icon secondary">
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
                <span class="badge bg-ucic-light text-ucic-primary px-3 py-1.5 rounded-pill">Sesi Aktif</span>
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
                            <span class="text-ucic-primary">38%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-ucic-primary" style="width: 38%;"></div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="d-flex justify-content-between mb-1 small fw-semibold">
                            <span>S1 Sistem Informasi</span>
                            <span class="text-ucic-secondary">25%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-ucic-secondary" style="width: 25%;"></div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="d-flex justify-content-between mb-1 small fw-semibold">
                            <span>S1 Desain Komunikasi Visual</span>
                            <span class="text-info">18%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-info" style="width: 18%;"></div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="d-flex justify-content-between mb-1 small fw-semibold">
                            <span>S1 Manajemen</span>
                            <span class="text-warning">12%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-warning" style="width: 12%;"></div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="d-flex justify-content-between mb-1 small fw-semibold">
                            <span>Lainnya (Akuntansi & D3)</span>
                            <span class="text-secondary">7%</span>
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
                    <th>Pelanggaran</th>
                    <th>Waktu Selesai</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentSessions as $session)
                <tr>
                    <td>
                        <div class="fw-semibold text-dark">{{ $session->participant->name ?? 'Peserta' }}</div>
                        <small class="text-muted">ID: PMB-2026-{{ str_pad($session->participant->id ?? 1, 3, '0', STR_PAD_LEFT) }}</small>
                    </td>
                    <td>{{ $session->participant->school_origin ?? '-' }}</td>
                    <td><span class="badge bg-ucic-light text-ucic-primary">{{ $session->participant->major_choice_1 ?? '-' }}</span></td>
                    <td><span class="badge bg-light text-dark">{{ $session->participant->major_choice_2 ?? '-' }}</span></td>
                    <td>
                        @if($session->status === 'finished')
                            <span class="badge-ucic-success"><i class="bi bi-check-circle me-1"></i>Selesai</span>
                        @else
                            <span class="badge-ucic-warning"><i class="bi bi-clock-history me-1"></i>Sedang Mengerjakan</span>
                        @endif
                    </td>
                    <td>
                        @if($session->violation_count >= 3)
                            <span class="badge bg-danger text-white rounded-pill px-2.5 py-1" style="font-size: 0.7rem;">🚨 {{ $session->violation_count }} Warning (Review)</span>
                        @elseif($session->violation_count > 0)
                            <span class="badge bg-warning text-dark rounded-pill px-2.5 py-1" style="font-size: 0.7rem;">⚠️ {{ $session->violation_count }} Warning</span>
                        @else
                            <span class="badge bg-success-subtle text-success rounded-pill px-2.5 py-1" style="font-size: 0.7rem;">🛡️ 0 (Aman)</span>
                        @endif
                    </td>
                    <td class="text-muted small">
                        {{ $session->finished_at ? $session->finished_at->format('d M Y, H:i') : '-' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">Belum ada peserta yang mengikuti ujian saat ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
