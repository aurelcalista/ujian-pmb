@extends('layouts.admin')

@section('title', 'Laporan Ujian - Admin CBT')
@section('page_heading', 'Laporan Hasil Ujian')

@section('admin_content')
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-4">
        <form method="GET" action="{{ url('/admin/reports') }}" class="row g-3 mb-4">
            <div class="col-md-4">
                <label class="form-label text-muted small fw-bold">Pilih Ujian</label>
                <select name="exam_id" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">Semua Ujian</option>
                    @foreach($exams as $exam)
                        <option value="{{ $exam->id }}" {{ request('exam_id') == $exam->id ? 'selected' : '' }}>
                            {{ $exam->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label text-muted small fw-bold">Filter Program Studi</label>
                <select name="prodi" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">Semua Program Studi</option>
                    @foreach($prodis as $prodi)
                        <option value="{{ $prodi }}" {{ request('prodi') == $prodi ? 'selected' : '' }}>
                            {{ $prodi }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5 d-flex align-items-end gap-2">
                <a href="{{ url('/admin/reports/print') }}?exam_id={{ request('exam_id') }}&prodi={{ request('prodi') }}" target="_blank" class="btn btn-secondary btn-sm px-3 flex-grow-1" title="Cetak HTML">
                    <i class="bi bi-printer me-1"></i>Cetak
                </a>
                <a href="{{ url('/admin/reports/print') }}?exam_id={{ request('exam_id') }}&prodi={{ request('prodi') }}&type=pdf" class="btn btn-danger btn-sm px-3 flex-grow-1" title="Unduh PDF">
                    <i class="bi bi-file-earmark-pdf me-1"></i>PDF
                </a>
                <a href="{{ url('/admin/reports/print') }}?exam_id={{ request('exam_id') }}&prodi={{ request('prodi') }}&type=word" class="btn btn-primary btn-sm px-3 flex-grow-1" title="Unduh Word">
                    <i class="bi bi-file-earmark-word me-1"></i>Word
                </a>
                <a href="{{ url('/admin/reports/print') }}?exam_id={{ request('exam_id') }}&prodi={{ request('prodi') }}&type=excel" class="btn btn-success btn-sm px-3 flex-grow-1" title="Unduh Excel">
                    <i class="bi bi-file-earmark-excel me-1"></i>Excel
                </a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Peserta</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ujian</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Program Studi</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Skor</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sessions as $index => $session)
                    <tr>
                        <td class="text-sm">{{ $sessions->firstItem() + $index }}</td>
                        <td>
                            <span class="fw-bold text-dark">{{ $session->participant->name ?? '-' }}</span>
                        </td>
                        <td class="text-sm">{{ $session->exam->title ?? '-' }}</td>
                        <td class="text-sm">
                            <div class="mb-1"><strong>1:</strong> {{ $session->participant->major_choice_1 ?? '-' }}</div>
                            <div><strong>2:</strong> {{ $session->participant->major_choice_2 ?? '-' }}</div>
                        </td>
                        <td>
                            <span class="badge bg-success bg-opacity-10 text-success border border-success fw-bold px-3 py-2" style="font-size: 0.85rem;">
                                {{ $session->score !== null ? $session->score : 'N/A' }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Belum ada data hasil ujian.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-4">
            {{ $sessions->links() }}
        </div>
    </div>
</div>
@endsection
