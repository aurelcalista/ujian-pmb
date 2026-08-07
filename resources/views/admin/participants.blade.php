@extends('layouts.admin')

@section('title', 'Data Peserta Ujian - Admin CBT UCIC')
@section('page_heading', 'Peserta Ujian PMB')

@section('admin_content')
<div class="ucic-card">
    <div class="ucic-card-header">
        <div class="row align-items-center g-3">
            <div class="col-md-6">
                <h6 class="fw-bold m-0 text-dark">Daftar Seluruh Peserta Ujian</h6>
                <small class="text-muted" style="font-size: 0.78rem;">Kelola data biodata dan status keikutsertaan ujian peserta</small>
            </div>
            <div class="col-md-6">
                <div class="d-flex align-items-center gap-2 justify-content-md-end">
                    <!-- Search Input -->
                    <div class="input-group" style="max-width: 260px;">
                        <span class="input-group-text bg-light text-muted border-end-0" style="border-radius: 10px 0 0 10px;">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control form-control-sm border-start-0" placeholder="Cari nama / sekolah..." style="border-radius: 0 10px 10px 0;">
                    </div>

                    <!-- Status Filter Dropdown -->
                    <select class="form-select form-select-sm" style="max-width: 160px; border-radius: 10px;">
                        <option value="">Semua Status</option>
                        <option value="selesai">Selesai</option>
                        <option value="mengerjakan">Sedang Ujian</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-ucic align-middle mb-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peserta</th>
                    <th>Asal Sekolah</th>
                    <th>Prodi Pilihan 1</th>
                    <th>Prodi Pilihan 2</th>
                    <th>Status Ujian</th>
                    <th>Waktu Selesai</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>
                        <div class="fw-bold text-dark">Ahmad Fauzi</div>
                        <small class="text-muted" style="font-size: 0.75rem;">ID: PMB-2026-001</small>
                    </td>
                    <td>SMAN 1 Cirebon</td>
                    <td><span class="badge bg-ucic-light text-ucic-primary">S1 Teknik Informatika</span></td>
                    <td><span class="badge bg-light text-dark border">S1 Sistem Informasi</span></td>
                    <td><span class="badge-ucic-success"><i class="bi bi-check-circle me-1"></i>Selesai</span></td>
                    <td class="text-muted small">07 Aug 2026, 11:15</td>
                    <td class="text-center">
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-light text-primary" title="Detail Peserta" onclick="alert('Detail Peserta: Ahmad Fauzi (SMAN 1 Cirebon)');">
                                <i class="bi bi-eye-fill"></i>
                            </button>
                            <button class="btn btn-light text-warning" title="Reset Akses Ujian" onclick="confirm('Apakah Anda yakin ingin mereset akses ujian peserta ini?');">
                                <i class="bi bi-arrow-counterclockwise"></i>
                            </button>
                            <button class="btn btn-light text-danger" title="Hapus Peserta" onclick="confirm('Apakah Anda yakin ingin menghapus peserta ini?');">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>2</td>
                    <td>
                        <div class="fw-bold text-dark">Bintang Pratama</div>
                        <small class="text-muted" style="font-size: 0.75rem;">ID: PMB-2026-002</small>
                    </td>
                    <td>SMKN 1 Cirebon</td>
                    <td><span class="badge bg-ucic-light text-ucic-primary">S1 Sistem Informasi</span></td>
                    <td><span class="badge bg-light text-dark border">S1 DKV</span></td>
                    <td><span class="badge-ucic-warning"><i class="bi bi-clock-history me-1"></i>Sedang Ujian</span></td>
                    <td class="text-muted small">-</td>
                    <td class="text-center">
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-light text-primary" title="Detail Peserta"><i class="bi bi-eye-fill"></i></button>
                            <button class="btn btn-light text-warning" title="Reset Ujian"><i class="bi bi-arrow-counterclockwise"></i></button>
                            <button class="btn btn-light text-danger" title="Hapus"><i class="bi bi-trash-fill"></i></button>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>3</td>
                    <td>
                        <div class="fw-bold text-dark">Citra Kirana</div>
                        <small class="text-muted" style="font-size: 0.75rem;">ID: PMB-2026-003</small>
                    </td>
                    <td>SMA BPK Penabur</td>
                    <td><span class="badge bg-ucic-light text-ucic-primary">S1 DKV</span></td>
                    <td><span class="badge bg-light text-dark border">S1 Manajemen</span></td>
                    <td><span class="badge-ucic-success"><i class="bi bi-check-circle me-1"></i>Selesai</span></td>
                    <td class="text-muted small">07 Aug 2026, 10:45</td>
                    <td class="text-center">
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-light text-primary" title="Detail Peserta"><i class="bi bi-eye-fill"></i></button>
                            <button class="btn btn-light text-warning" title="Reset Ujian"><i class="bi bi-arrow-counterclockwise"></i></button>
                            <button class="btn btn-light text-danger" title="Hapus"><i class="bi bi-trash-fill"></i></button>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>4</td>
                    <td>
                        <div class="fw-bold text-dark">Dewi Sartika</div>
                        <small class="text-muted" style="font-size: 0.75rem;">ID: PMB-2026-004</small>
                    </td>
                    <td>SMA Al-Azhar Cirebon</td>
                    <td><span class="badge bg-ucic-light text-ucic-primary">S1 Manajemen</span></td>
                    <td><span class="badge bg-light text-dark border">S1 Akuntansi</span></td>
                    <td><span class="badge-ucic-success"><i class="bi bi-check-circle me-1"></i>Selesai</span></td>
                    <td class="text-muted small">07 Aug 2026, 10:30</td>
                    <td class="text-center">
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-light text-primary" title="Detail Peserta"><i class="bi bi-eye-fill"></i></button>
                            <button class="btn btn-light text-warning" title="Reset Ujian"><i class="bi bi-arrow-counterclockwise"></i></button>
                            <button class="btn btn-light text-danger" title="Hapus"><i class="bi bi-trash-fill"></i></button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="p-3 border-top d-flex align-items-center justify-content-between">
        <small class="text-muted">Menampilkan 1-4 dari 1,248 data peserta</small>
        <ul class="pagination pagination-sm m-0">
            <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
    </div>
</div>
@endsection
