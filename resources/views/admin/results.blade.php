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
                    <form method="GET" action="{{ url('/admin/results') }}" class="d-flex align-items-center me-2">
                        <select name="prodi" class="form-select form-select-sm border-0 shadow-sm" style="min-width: 180px;" onchange="this.form.submit()">
                            <option value="">Semua Program Studi</option>
                            @foreach($prodis as $prodi)
                                <option value="{{ $prodi }}" {{ request('prodi') == $prodi ? 'selected' : '' }}>{{ $prodi }}</option>
                            @endforeach
                        </select>
                    </form>

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
                    <th class="text-center">Nilai Akhir</th>
                    <th class="text-center">Status Keamanan</th>
                    <th>Status Ujian</th>
                    <th>Waktu Selesai</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sessions as $session)
                @php
                    $correctCount = 0;
                    $totalQuestions = count($session->answers);
                    foreach($session->answers as $ans) {
                        if ($ans->option && $ans->option->is_correct) {
                            $correctCount++;
                        }
                    }
                @endphp
                <tr>
                    <td>
                        <div class="fw-bold text-dark">{{ $session->participant->name ?? 'Peserta' }}</div>
                        <small class="text-muted">PMB-2026-{{ str_pad($session->participant->id ?? 1, 3, '0', STR_PAD_LEFT) }}</small>
                    </td>
                    <td>{{ $session->participant->school_origin ?? '-' }}</td>
                    <td>
                        <div class="small fw-semibold text-ucic-primary">1. {{ $session->participant->major_choice_1 ?? '-' }}</div>
                        <div class="small text-muted">2. {{ $session->participant->major_choice_2 ?? '-' }}</div>
                    </td>
                    <td class="text-center">
                        @if($session->status === 'finished')
                            <span class="badge bg-success px-2.5 py-1 rounded-pill" style="font-size: 0.82rem;">{{ number_format($session->score ?? 0, 1) }}</span>
                        @else
                            <span class="text-muted fw-bold">-</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($session->violation_count >= 3)
                            <span class="badge bg-danger text-white rounded-pill px-2.5 py-1" style="font-size: 0.72rem;">🚨 {{ $session->security_status }} ({{ $session->violation_count }} Warning)</span>
                        @elseif($session->violation_count > 0)
                            <span class="badge bg-warning text-dark rounded-pill px-2.5 py-1" style="font-size: 0.72rem;">⚠️ {{ $session->violation_count }} Warning</span>
                        @else
                            <span class="badge bg-success-subtle text-success rounded-pill px-2.5 py-1" style="font-size: 0.72rem;">🛡️ Aman (0 Warning)</span>
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
                    <td class="text-muted small">{{ $session->finished_at ? $session->finished_at->format('d M Y, H:i') : '-' }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-1">
                            @if($session->status === 'finished')
                                <button class="btn btn-sm btn-ucic-outline" data-bs-toggle="modal" data-bs-target="#detailModal{{ $session->id }}" title="Detail Hasil">
                                    <i class="bi bi-file-text"></i>
                                </button>
                            @else
                                <span class="btn btn-sm text-muted" style="pointer-events: none;">-</span>
                            @endif

                            @if($session->violation_count >= ($session->exam->max_violation ?? 3) || str_contains($session->security_status, 'Diblokir'))
                                <form action="{{ url('/admin/sessions/' . $session->id . '/unblock') }}" method="POST" id="unblockForm{{ $session->id }}">
                                    @csrf
                                    <button type="button" class="btn btn-sm btn-outline-success btn-unblock-session" data-id="{{ $session->id }}" title="Buka Blokir & Ujian Ulang">
                                        <i class="bi bi-unlock-fill"></i>
                                    </button>
                                </form>
                            @endif

                            <form action="{{ url('/admin/sessions/' . $session->id) }}" method="POST" id="deleteForm{{ $session->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-outline-danger btn-delete-session" data-id="{{ $session->id }}" title="Hapus Data">
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
                                        <small class="text-muted d-block">Status Keamanan</small>
                                        <strong class="text-danger">{{ $session->security_status }} ({{ $session->violation_count }} Pelanggaran)</strong>
                                    </div>
                                    <div class="col-md-4">
                                        <small class="text-muted d-block">Waktu Mulai & Selesai</small>
                                        <span class="small text-muted">{{ $session->started_at ? $session->started_at->format('H:i') : '' }} - {{ $session->finished_at ? $session->finished_at->format('H:i') : '' }}</span>
                                    </div>
                                </div>

                                <h6 class="fw-bold text-ucic-primary mb-2"><i class="bi bi-shield-exclamation me-1"></i> Log Catatan Anti-Cheat & Pelanggaran</h6>
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
                    <td colspan="7" class="text-center py-4 text-muted">Belum ada hasil ujian peserta.</td>
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
