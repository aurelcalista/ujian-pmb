@extends('layouts.admin')

@section('title', 'Detail Ujian - Admin CBT UCIC')
@section('page_heading', 'Detail Ujian')

@section('admin_content')
<!-- TOP HEADER BAR -->
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="fw-bold m-0 text-dark">Detail Ujian: {{ $exam->title }}</h4>
        <small class="text-muted">Melihat informasi ujian dan bank soal</small>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ url('/admin/exams/' . $exam->id . '/edit') }}" class="btn btn-warning px-4 py-2.5 fw-semibold rounded-3 d-inline-flex align-items-center gap-2">
            <i class="bi bi-pencil-square fs-5"></i>
            <span>Edit Ujian</span>
        </a>
        <a href="{{ url('/admin/exams') }}" class="btn btn-secondary px-4 py-2.5 fw-semibold rounded-3 d-inline-flex align-items-center gap-2">
            <span>Kembali</span>
        </a>
    </div>
</div>

<!-- CARD 1: INFORMASI UJIAN -->
<div class="ucic-card mb-4">
    <div class="ucic-card-header bg-light">
        <h6 class="fw-bold m-0 text-dark">Informasi Ujian</h6>
    </div>

    <div class="ucic-card-body p-4">
        <div class="row mb-3">
            <div class="col-md-3 text-muted fw-semibold">Judul Ujian</div>
            <div class="col-md-9 fw-bold">{{ $exam->title }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3 text-muted fw-semibold">Deskripsi / Kategori</div>
            <div class="col-md-9">{{ $exam->description }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3 text-muted fw-semibold">Program Studi</div>
            <div class="col-md-9">
                @if($exam->studyProgram)
                    <span class="badge bg-primary">{{ $exam->studyProgram->name }}</span>
                @else
                    <span class="badge bg-secondary">Berlaku untuk Semua / Default</span>
                @endif
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3 text-muted fw-semibold">Pelaksanaan</div>
            <div class="col-md-9">
                {{ $exam->start_time ? $exam->start_time->format('d M Y H:i') : '-' }} 
                s/d 
                {{ $exam->end_time ? $exam->end_time->format('d M Y H:i') : '-' }}
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3 text-muted fw-semibold">Durasi Ujian</div>
            <div class="col-md-9">{{ $exam->duration }} Menit</div>
        </div>
    </div>
</div>

<!-- CARD 2: DAFTAR SOAL -->
<div class="d-flex align-items-center justify-content-between mb-3">
    <h5 class="fw-bold m-0 text-dark">Daftar Soal & Jawaban</h5>
    <span class="badge bg-info text-dark px-3 py-2 fs-6 rounded-pill">Total: {{ $exam->questions->count() }} Soal</span>
</div>

<div class="space-y-4">
    @forelse($exam->questions as $index => $q)
    <div class="ucic-card mb-4">
        <div class="ucic-card-header bg-light d-flex align-items-center justify-content-between py-2.5">
            <span class="fw-bold text-dark" style="font-size: 0.95rem;">Soal #{{ $index + 1 }} (Bobot: {{ $q->weight }})</span>
        </div>

        <div class="ucic-card-body p-4">
            @if($q->image)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $q->image) }}" alt="Gambar Soal" class="img-thumbnail" style="max-height: 200px;">
                </div>
            @endif
            <p class="fw-medium mb-3 fs-5">{!! nl2br(e($q->question_text)) !!}</p>
            
            <div class="list-group">
                @foreach($q->options as $optIdx => $opt)
                    <div class="list-group-item {{ $opt->is_correct ? 'list-group-item-success fw-bold' : '' }}">
                        <span class="me-2">{{ chr(65 + $optIdx) }}.</span> 
                        {{ $opt->option_text }}
                        @if($opt->is_correct)
                            <i class="bi bi-check-circle-fill text-success float-end mt-1"></i>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @empty
    <div class="alert alert-warning">
        Belum ada soal untuk ujian ini. Silakan klik tombol <strong>Edit Ujian</strong> untuk menambahkan soal.
    </div>
    @endforelse
</div>

@endsection
