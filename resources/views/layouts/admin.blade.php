<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel CBT - Universitas Catur Insan Cendekia')</title>

    <!-- Favicon / Logo UCIC Emblem Only -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon-ucic.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon-ucic.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/favicon-ucic.png') }}">

    <!-- Google Fonts Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Custom UCIC CBT Styles -->
    <link rel="stylesheet" href="{{ asset('css/ucic-cbt.css') }}">
    @stack('styles')
</head>
<body>

    <div class="d-flex">
        <!-- ADMIN SIDEBAR -->
        <aside class="admin-sidebar" id="adminSidebar">
            <div class="sidebar-brand d-flex align-items-center gap-2.5">
                <img src="{{ asset('images/logo-ucic.png') }}" alt="UCIC Logo" class="ucic-logo-img-sm" style="flex-shrink: 0;">
                <div style="min-width: 0;">
                    <h6 class="fw-bold text-ucic-primary m-0 text-nowrap" style="font-size: 0.88rem; line-height: 1.2;">UCIC CBT</h6>
                    <small class="text-ucic-muted text-nowrap d-block" style="font-size: 0.7rem; line-height: 1.2;">Admin Panel PMB</small>
                </div>
            </div>

            <div class="sidebar-menu">
                <div class="text-uppercase text-muted fw-bold px-3 mb-2" style="font-size: 0.65rem; letter-spacing: 0.8px;">Menu Utama</div>
                
                <a href="{{ url('/admin/dashboard') }}" class="sidebar-link @if(request()->is('admin/dashboard') || request()->is('admin')) active @endif">
                    <i class="bi bi-grid-1x2-fill"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ url('/admin/exams') }}" class="sidebar-link @if(request()->is('admin/exams*') && !request()->is('admin/exams/*/results') || request()->is('admin/questions*')) active @endif">
                    <i class="bi bi-card-checklist"></i>
                    <span>Ujian</span>
                </a>

                <a href="{{ url('/admin/results') }}" class="sidebar-link @if(request()->is('admin/results') || request()->is('admin/exams/*/results')) active @endif">
                    <i class="bi bi-people-fill"></i>
                    <span>Peserta & Hasil Ujian</span>
                </a>

                <a href="{{ url('/admin/study-programs') }}" class="sidebar-link @if(request()->is('admin/study-programs')) active @endif">
                    <i class="bi bi-journal-bookmark-fill"></i>
                    <span>Program Studi</span>
                </a>

                <div class="text-uppercase text-muted fw-bold px-3 mt-3 mb-2" style="font-size: 0.65rem; letter-spacing: 0.8px;">Sistem</div>

                <a href="{{ url('/admin/settings') }}" class="sidebar-link @if(request()->is('admin/settings')) active @endif">
                    <i class="bi bi-gear-fill"></i>
                    <span>Pengaturan</span>
                </a>

                <a href="{{ url('/admin/login') }}" class="sidebar-link text-danger mt-2">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Keluar (Logout)</span>
                </a>
            </div>

            <div class="p-2.5 border-top text-center sidebar-footer">
                <small class="text-muted" style="font-size: 0.7rem;">PMB UCIC &copy; {{ date('Y') }}</small>
            </div>
        </aside>

        <!-- MAIN CONTENT AREA -->
        <main class="admin-main flex-grow-1">
            <!-- TOPBAR -->
            <header class="admin-topbar">
                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-topbar-toggle" type="button" onclick="toggleAdminSidebar()" title="Buka / Tutup Sidebar">
                        <i class="bi bi-justify fs-5"></i>
                    </button>
                    <div>
                        <h5 class="fw-bold m-0" style="font-size: 0.98rem; line-height: 1.25;">@yield('page_heading', 'Dashboard Overview')</h5>
                        <small class="text-muted" style="font-size: 0.72rem; line-height: 1.3; display: block; margin-top: 1px;">Penerimaan Mahasiswa Baru Universitas Catur Insan Cendekia</small>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-2 sm:gap-3">
                    <!-- Dark Mode / Light Mode Toggle -->
                    <button class="btn btn-topbar-icon me-1" type="button" onclick="toggleTheme()" title="Beralih Mode Gelap/Terang">
                        <i class="bi bi-moon-stars-fill fs-5 text-muted theme-toggle-icon"></i>
                    </button>

                    <!-- Admin Profile Badge (CIC Original) -->
                    <div class="d-flex align-items-center gap-2 ps-2.5 border-start">
                        <div class="rounded-circle bg-ucic-primary text-white d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 36px; height: 36px; font-size: 0.85rem; flex-shrink: 0;">
                            AD
                        </div>
                        <div class="d-none d-md-block text-start" style="line-height: 1.2;">
                            <div class="fw-bold" style="font-size: 0.82rem;">Panitia PMB</div>
                            <small class="text-muted" style="font-size: 0.7rem;">Administrator</small>
                        </div>
                    </div>
                </div>
            </header>

            <!-- PAGE CONTENT -->
            <div class="p-4 flex-grow-1">
                @yield('admin_content')
            </div>
        </main>
    </div>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/ucic-cbt.js') }}"></script>
    
    <!-- SweetAlert Flash Message Handler -->
    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        });
    </script>
    @endif
    @if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Gagal!',
                text: '{{ session('error') }}',
                icon: 'error',
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        });
    </script>
    @endif

    @stack('scripts')
</body>
</html>
