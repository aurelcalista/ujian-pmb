<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel CBT - Universitas Catur Insan Cendekia')</title>

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
            <div class="sidebar-brand d-flex align-items-center gap-3">
                <img src="{{ asset('images/logo-ucic.png') }}" alt="UCIC Logo" class="ucic-logo-img-sm">
                <div>
                    <h6 class="fw-bold text-ucic-primary m-0" style="font-size: 0.95rem; line-height: 1.2;">UCIC CBT</h6>
                    <small class="text-ucic-muted" style="font-size: 0.75rem;">Admin Panel PMB</small>
                </div>
            </div>

            <div class="sidebar-menu">
                <div class="text-uppercase text-muted fw-bold px-3 mb-2" style="font-size: 0.7rem; letter-spacing: 0.8px;">Menu Utama</div>
                
                <a href="{{ url('/admin/dashboard') }}" class="sidebar-link @if(request()->is('admin/dashboard') || request()->is('admin')) active @endif">
                    <i class="bi bi-grid-1x2-fill"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ url('/admin/participants') }}" class="sidebar-link @if(request()->is('admin/participants')) active @endif">
                    <i class="bi bi-people-fill"></i>
                    <span>Peserta Ujian</span>
                </a>

                <a href="{{ url('/admin/questions') }}" class="sidebar-link @if(request()->is('admin/questions')) active @endif">
                    <i class="bi bi-journal-text"></i>
                    <span>Bank Soal</span>
                </a>

                <a href="{{ url('/admin/results') }}" class="sidebar-link @if(request()->is('admin/results')) active @endif">
                    <i class="bi bi-trophy-fill"></i>
                    <span>Hasil Ujian</span>
                </a>

                <div class="text-uppercase text-muted fw-bold px-3 mt-4 mb-2" style="font-size: 0.7rem; letter-spacing: 0.8px;">Sistem</div>

                <a href="{{ url('/admin/settings') }}" class="sidebar-link @if(request()->is('admin/settings')) active @endif">
                    <i class="bi bi-gear-fill"></i>
                    <span>Pengaturan</span>
                </a>

                <a href="{{ url('/admin/login') }}" class="sidebar-link text-danger mt-3">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Keluar (Logout)</span>
                </a>
            </div>

            <div class="p-3 border-top bg-light text-center">
                <small class="text-muted" style="font-size: 0.75rem;">PMB UCIC &copy; {{ date('Y') }}</small>
            </div>
        </aside>

        <!-- MAIN CONTENT AREA -->
        <main class="admin-main flex-grow-1">
            <!-- TOPBAR -->
            <header class="admin-topbar">
                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-light d-lg-none" type="button" onclick="document.getElementById('adminSidebar').classList.toggle('show')">
                        <i class="bi bi-list fs-5"></i>
                    </button>
                    <div>
                        <h5 class="fw-bold m-0" style="font-size: 1.1rem;">@yield('page_heading', 'Dashboard Administrator')</h5>
                        <small class="text-muted" style="font-size: 0.8rem;">Penerimaan Mahasiswa Baru Universitas Catur Insan Cendekia</small>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <!-- Notification Icon -->
                    <div class="position-relative cursor-pointer">
                        <i class="bi bi-bell fs-5 text-muted"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">3</span>
                    </div>

                    <!-- Admin Profile Badge -->
                    <div class="d-flex align-items-center gap-2 ps-3 border-start">
                        <div class="rounded-circle bg-ucic-primary text-white d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px; font-size: 0.9rem;">
                            AD
                        </div>
                        <div class="d-none d-md-block text-start" style="line-height: 1.2;">
                            <div class="fw-semibold" style="font-size: 0.88rem;">Panitia PMB</div>
                            <small class="text-muted" style="font-size: 0.75rem;">Administrator</small>
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
    <script src="{{ asset('js/ucic-cbt.js') }}"></script>
    @stack('scripts')
</body>
</html>
