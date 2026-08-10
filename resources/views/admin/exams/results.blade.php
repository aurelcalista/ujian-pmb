@extends('layouts.admin')

@section('title', 'Monitoring Hasil Ujian - Admin CBT UCIC')
@section('page_heading', 'Monitoring Hasil Ujian')

@section('admin_content')
<!-- TOP HEADER BAR -->
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="fw-bold m-0 text-dark">Monitoring Hasil Ujian: {{ $exam->title }}</h4>
        <p class="text-muted small m-0">{{ $exam->description }}</p>
    </div>
    <a href="{{ url('/admin/exams') }}" class="btn btn-outline-secondary px-4 py-2 fw-semibold rounded-3 d-inline-flex align-items-center gap-2">
        <i class="bi bi-arrow-left me-1"></i>
        <span>Kembali ke Daftar</span>
    </a>
</div>

<!-- 4 VIBRANT STAT CARDS (Matching Image #1 Design & Colors) -->
<div class="row g-3 mb-4">
    
    <!-- Stat 1: Partisipasi (Blue Card) -->
    <div class="col-xl-3 col-md-6">
        <div class="p-4 rounded-4 text-white shadow-sm d-flex align-items-center justify-content-between position-relative overflow-hidden" style="background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%);">
            <div>
                <small class="fw-semibold text-white-50 d-block text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">Partisipasi</small>
                <h2 class="fw-extrabold m-0 mt-1" style="font-size: 1.8rem;">{{ $completedCount }} / {{ $totalParticipants }}</h2>
                <small class="text-white-50 fw-medium" style="font-size: 0.75rem;">Peserta mengerjakan</small>
            </div>
            <div class="d-flex align-items-center justify-content-center text-white-50" style="font-size: 3rem; opacity: 0.85;">
                <i class="bi bi-people-fill"></i>
            </div>
        </div>
    </div>

    <!-- Stat 2: Rata-rata (Green Card) -->
    <div class="col-xl-3 col-md-6">
        <div class="p-4 rounded-4 text-white shadow-sm d-flex align-items-center justify-content-between position-relative overflow-hidden" style="background: linear-gradient(135deg, #059669 0%, #047857 100%);">
            <div>
                <small class="fw-semibold text-white-50 d-block text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">Rata-rata</small>
                <h2 class="fw-extrabold m-0 mt-1" style="font-size: 1.8rem;">{{ number_format($avgScore, 0) }}</h2>
                <small class="text-white-50 fw-medium" style="font-size: 0.75rem;">Dari 100</small>
            </div>
            <div class="d-flex align-items-center justify-content-center text-white-50" style="font-size: 3rem; opacity: 0.85;">
                <i class="bi bi-graph-up-arrow"></i>
            </div>
        </div>
    </div>

    <!-- Stat 3: Nilai Tertinggi (Cyan/Blue Card) -->
    <div class="col-xl-3 col-md-6">
        <div class="p-4 rounded-4 text-white shadow-sm d-flex align-items-center justify-content-between position-relative overflow-hidden" style="background: linear-gradient(135deg, #06B6D4 0%, #0891B2 100%);">
            <div>
                <small class="fw-semibold text-white-50 d-block text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">Nilai Tertinggi</small>
                <h2 class="fw-extrabold m-0 mt-1" style="font-size: 1.8rem;">{{ number_format($maxScore, 0) }}</h2>
            </div>
            <div class="d-flex align-items-center justify-content-center text-white-50" style="font-size: 3rem; opacity: 0.85;">
                <i class="bi bi-trophy-fill"></i>
            </div>
        </div>
    </div>

    <!-- Stat 4: Nilai Terendah (Red Card) -->
    <div class="col-xl-3 col-md-6">
        <div class="p-4 rounded-4 text-white shadow-sm d-flex align-items-center justify-content-between position-relative overflow-hidden" style="background: linear-gradient(135deg, #DC2626 0%, #B91C1C 100%);">
            <div>
                <small class="fw-semibold text-white-50 d-block text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">Nilai Terendah</small>
                <h2 class="fw-extrabold m-0 mt-1" style="font-size: 1.8rem;">{{ number_format($minScore, 0) }}</h2>
            </div>
            <div class="d-flex align-items-center justify-content-center text-white-50" style="font-size: 3rem; opacity: 0.85;">
                <i class="bi bi-exclamation-triangle-fill"></i>
            </div>
        </div>
    </div>

</div>

<!-- DAFTAR NILAI PESERTA TABLE CARD (Matching Image #1 Structure) -->
<div class="ucic-card">
    <div class="ucic-card-header bg-light d-flex justify-content-between align-items-center">
        <h6 class="fw-bold m-0 text-dark">Daftar Nilai Peserta</h6>
        <form method="GET" action="{{ url('/admin/exams/'.$exam->id.'/results') }}" class="d-flex align-items-center gap-2">
            <select name="prodi" class="form-select form-select-sm border-0 shadow-sm" style="min-width: 200px;" onchange="this.form.submit()">
                <option value="">Semua Program Studi</option>
                @foreach($prodis as $prodi)
                    <option value="{{ $prodi }}" {{ request('prodi') == $prodi ? 'selected' : '' }}>{{ $prodi }}</option>
                @endforeach
            </select>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-ucic align-middle mb-0">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 25%;">Nama Peserta</th>
                    <th style="width: 20%;">Asal Sekolah</th>
                    <th style="width: 15%;">Waktu Submit</th>
                    <th style="width: 10%;">Durasi</th>
                    <th class="text-center" style="width: 10%;">B / S / K</th>
                    <th class="text-center" style="width: 8%;">Nilai</th>
                    <th style="width: 12%;">Status</th>
                    <th class="text-center" style="width: 10%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sessions as $index => $session)
                @php
                    $correctCount = 0;
                    $wrongCount = 0;
                    $unansweredCount = 0;
                    $totalQuestions = count($exam->questions);

                    foreach($session->answers as $ans) {
                        if ($ans->option && $ans->option->is_correct) {
                            $correctCount++;
                        } else if ($ans->option_id) {
                            $wrongCount++;
                        }
                    }
                    $unansweredCount = max(0, $totalQuestions - ($correctCount + $wrongCount));

                    $durationText = '-';
                    if ($session->started_at && $session->finished_at) {
                        $diffSecs = $session->finished_at->diffInSeconds($session->started_at);
                        if ($diffSecs < 60) {
                            $durationText = $diffSecs . ' detik';
                        } else {
                            $durationText = round($diffSecs / 60) . ' menit';
                        }
                    }
                @endphp
                <tr>
                    <td>{{ $sessions->firstItem() + $index }}</td>
                    <td>
                        <div class="fw-bold text-dark" style="font-size: 0.92rem;">{{ $session->participant->name ?? 'Peserta' }}</div>
                        <small class="text-muted d-block" style="font-size: 0.72rem;">Prodi 1: {{ $session->participant->major_choice_1 ?? '-' }}</small>
                        <small class="text-muted d-block" style="font-size: 0.72rem;">Prodi 2: {{ $session->participant->major_choice_2 ?? '-' }}</small>
                    </td>
                    <td>
                        <div class="fw-medium text-secondary">{{ $session->participant->school_origin ?? '-' }}</div>
                    </td>
                    <td>
                        <div class="small fw-medium text-dark">
                            {{ $session->finished_at ? $session->finished_at->format('d/m/Y H:i') : '-' }}
                        </div>
                    </td>
                    <td>
                        <span class="small text-muted">{{ $durationText }}</span>
                    </td>
                    <td class="text-center">
                        <span class="fw-bold text-dark" style="font-size: 0.88rem;">
                            <span class="text-success">{{ $correctCount }}</span> / 
                            <span class="text-danger">{{ $wrongCount }}</span> / 
                            <span class="text-muted">{{ $unansweredCount }}</span>
                        </span>
                    </td>
                    <td class="text-center">
                        @if($session->status === 'finished')
                            <span class="badge rounded-pill bg-danger px-2.5 py-1 fw-bold" style="font-size: 0.82rem; background-color: #DC2626 !important;">
                                {{ number_format($session->score ?? 0, 0) }}
                            </span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        @if($session->status === 'finished')
                            <span class="badge bg-success-subtle text-success border border-success rounded-pill px-3 py-1 fw-semibold" style="font-size: 0.75rem;">
                                Selesai
                            </span>
                        @elseif($session->status === 'ongoing')
                            <span class="badge bg-warning-subtle text-warning border border-warning rounded-pill px-3 py-1 fw-semibold" style="font-size: 0.75rem;">
                                Sedang Ujian
                            </span>
                        @else
                            <span class="badge bg-light text-muted border rounded-pill px-3 py-1 fw-semibold" style="font-size: 0.75rem;">
                                Belum Mengerjakan
                            </span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-1">
                            @if($session->status === 'finished')
                                <button class="btn btn-outline-danger btn-sm px-3 rounded-2 fw-medium" style="font-size: 0.78rem; border-color: #F87171; color: #DC2626;" data-bs-toggle="modal" data-bs-target="#detailModal{{ $session->id }}" title="Lihat Detail">
                                    <i class="bi bi-file-text"></i>
                                </button>
                            @else
                                <span class="btn btn-sm text-muted" style="pointer-events: none;">-</span>
                            @endif

                            @if($session->violation_count >= ($session->exam->max_violation ?? 3) || str_contains($session->security_status, 'Diblokir'))
                                <form action="{{ url('/admin/sessions/' . $session->id . '/unblock') }}" method="POST" id="unblockForm{{ $session->id }}">
                                    @csrf
                                    <button type="button" class="btn btn-sm btn-outline-success rounded-2 btn-unblock-session" data-id="{{ $session->id }}" title="Buka Blokir & Ujian Ulang">
                                        <i class="bi bi-unlock-fill"></i>
                                    </button>
                                </form>
                            @endif

                            <form action="{{ url('/admin/sessions/' . $session->id) }}" method="POST" id="deleteForm{{ $session->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-outline-secondary rounded-2 btn-delete-session" data-id="{{ $session->id }}" title="Hapus Data">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>

                <!-- DETAIL MODAL PER SESSION -->
                <div class="modal fade" id="detailModal{{ $session->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content rounded-4 border-0 shadow-lg">
                            <div class="modal-header bg-ucic-primary text-white" style="border-radius: 18px 18px 0 0;">
                                <h5 class="modal-title fw-bold fs-6">Detail Hasil & Anti-Cheat Audit: {{ $session->participant->name ?? 'Peserta' }}</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4 text-start">
                                <div class="row g-3 mb-4 bg-light p-3 rounded-3">
                                    <div class="col-md-6">
                                        <small class="text-muted d-block">Nama Lengkap</small>
                                        <strong class="text-dark">{{ $session->participant->name ?? '-' }}</strong>
                                    </div>
                                    <div class="col-md-6">
                                        <small class="text-muted d-block">Asal Sekolah</small>
                                        <strong class="text-dark">{{ $session->participant->school_origin ?? '-' }}</strong>
                                    </div>
                                    <div class="col-md-4">
                                        <small class="text-muted d-block">Nilai Akhir</small>
                                        <strong class="text-success fs-5">{{ number_format($session->score ?? 0, 1) }} / 100</strong>
                                    </div>
                                    <div class="col-md-4">
                                        <small class="text-muted d-block">Jawaban (B / S / K)</small>
                                        <strong class="text-dark">{{ $correctCount }} Benar / {{ $wrongCount }} Salah / {{ $unansweredCount }} Kosong</strong>
                                    </div>
                                    <div class="col-md-4">
                                        <small class="text-muted d-block">Status Keamanan</small>
                                        <strong class="text-danger">{{ $session->security_status }} ({{ $session->violation_count }} Warning)</strong>
                                    </div>
                                </div>

                                <h6 class="fw-bold text-ucic-primary mb-2"><i class="bi bi-shield-exclamation me-1"></i> Log Catatan Anti-Cheat Pelanggaran</h6>
                                <div class="border rounded-3 p-3 mb-4 bg-white" style="max-height: 180px; overflow-y: auto;">
                                    @forelse($session->logs as $log)
                                    <div class="d-flex align-items-center justify-content-between border-bottom py-1.5 small">
                                        <span class="text-danger fw-semibold">Warning #{{ $log->violation_number }}: {{ $log->activity_type }}</span>
                                        <span class="text-muted">{{ $log->description }} ({{ $log->created_at ? $log->created_at->format('H:i:s') : '' }})</span>
                                    </div>
                                    @empty
                                    <span class="text-success small"><i class="bi bi-shield-check me-1"></i>Tidak ada aktivitas pelanggaran yang tercatat selama ujian. Status Peserta: Aman.</span>
                                    @endforelse
                                </div>

                                <h6 class="fw-bold text-ucic-primary mb-2 mt-4"><i class="bi bi-list-check me-1"></i> Detail Jawaban Peserta</h6>
                                <div class="border rounded-3 p-3 mb-4 bg-white" style="max-height: 250px; overflow-y: auto;">
                                    @forelse($session->answers as $index => $ans)
                                    <div class="d-flex align-items-center justify-content-between border-bottom py-2 small">
                                        <div>
                                            <strong>Soal {{ $index + 1 }}:</strong> 
                                            <span class="text-muted">{!! strip_tags(Str::limit($ans->question->question_text ?? 'Soal dihapus', 60)) !!}</span>
                                        </div>
                                        <div>
                                            @if($ans->option)
                                                @if($ans->option->is_correct)
                                                    <span class="badge bg-success-subtle text-success border border-success"><i class="bi bi-check-circle me-1"></i>Benar</span>
                                                @else
                                                    <span class="badge bg-danger-subtle text-danger border border-danger"><i class="bi bi-x-circle me-1"></i>Salah</span>
                                                @endif
                                            @else
                                                <span class="badge bg-light text-muted border">Kosong</span>
                                            @endif
                                        </div>
                                    </div>
                                    @empty
                                    <span class="text-muted small">Belum ada jawaban.</span>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <tr>
                    <td colspan="9" class="text-center py-4 text-muted">Belum ada peserta yang mengikuti ujian ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($sessions->hasPages())
    <div class="ucic-card-footer border-top bg-white p-3">
        {{ $sessions->links() }}
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.btn-delete-session');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const sessionId = this.getAttribute('data-id');
            const form = document.getElementById('deleteForm' + sessionId);
            
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data peserta ini beserta seluruh riwayat ujian, jawaban, dan rekaman kecurangannya akan dihapus secara permanen dari database!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus Data!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    const unblockButtons = document.querySelectorAll('.btn-unblock-session');
    
    unblockButtons.forEach(button => {
        button.addEventListener('click', function() {
            const sessionId = this.getAttribute('data-id');
            const form = document.getElementById('unblockForm' + sessionId);
            
            Swal.fire({
                title: 'Buka Akses Ujian?',
                text: "Peserta yang sudah diblokir akan dipulihkan aksesnya. Mereka bisa melanjutkan ujian dari soal terakhir tanpa kehilangan jawaban sebelumnya. Log pelanggaran juga akan direset.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Buka Blokir!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>
@endpush
