@extends('layouts.app')

@section('title', 'Computer Based Test (CBT) PMB - Universitas Catur Insan Cendekia (UCIC)')

@section('content')
<div class="ucic-landing-bg position-relative d-flex flex-column flex-grow-1">

    <!-- DECORATIVE BACKGROUND AMBIENT BLOBS & GEOMETRIC OVERLAY -->
    <div class="ambient-blob ambient-blob-1"></div>
    <div class="ambient-blob ambient-blob-2"></div>
    <div class="ambient-blob ambient-blob-3"></div>
    <div class="geometric-grid-overlay"></div>

    <!-- HEADER / STICKY FLOATING PILL NAVBAR WITH MOBILE HAMBURGER -->
    <header class="ucic-floating-navbar-wrapper">
        <div class="container d-flex flex-column align-items-center px-2 px-sm-3">
            
            <div class="ucic-floating-navbar d-flex align-items-center justify-content-between gap-2 gap-md-3">
                
                <!-- Left: Logo & Brand Titles -->
                <a href="{{ url('/') }}" class="d-flex align-items-center gap-2 gap-md-3 text-decoration-none">
                    <img src="{{ asset('images/logo-ucic.png') }}" alt="UCIC Logo" class="navbar-logo-img">
                    
                    <div class="d-flex flex-column text-start border-start ps-2.5 ps-md-3">
                        <span class="nav-brand-title" style="font-size: 0.92rem; font-weight: 700; color: var(--ucic-primary); line-height: 1.2;">Computer Based Test PMB</span>
                        <span class="nav-brand-subtitle d-none d-sm-block" style="font-size: 0.72rem; color: var(--ucic-text-muted); line-height: 1.2;">Universitas Catur Insan Cendekia</span>
                    </div>
                </a>

                <!-- Desktop Navigation Pills -->
                <div class="d-none d-md-flex align-items-center gap-1">
                    <a href="{{ url('/') }}" class="btn btn-pill-nav active">Beranda</a>
                    <a href="{{ url('/student/form') }}" class="btn btn-pill-nav">Form Ujian</a>
                </div>

                <!-- Mobile Hamburger Toggle Button -->
                <button class="btn btn-pill-hamburger d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#mobilePillMenu" aria-expanded="false" aria-label="Toggle Navigation">
                    <i class="bi bi-list fs-4"></i>
                </button>

            </div>

            <!-- Mobile Collapsible Menu Card -->
            <div class="collapse w-100 d-md-none" id="mobilePillMenu" style="max-width: 960px;">
                <div class="ucic-mobile-pill-menu d-flex flex-column gap-2 text-center">
                    <a href="{{ url('/') }}" class="btn btn-pill-nav active py-2.5">
                        <i class="bi bi-house-door-fill me-1"></i> Beranda
                    </a>
                    <a href="{{ url('/student/form') }}" class="btn btn-pill-nav py-2.5">
                        <i class="bi bi-journal-text me-1"></i> Form Ujian
                    </a>
                </div>
            </div>

        </div>
    </header>

    <!-- HERO SECTION -->
    <main class="flex-grow-1 d-flex flex-column justify-content-center py-4 py-lg-5 position-relative" style="z-index: 2;">
        <div class="container my-auto">
            <div class="row align-items-center g-4 g-lg-5">
                
                <!-- LEFT COLUMN: HERO TEXT & ACTIONS -->
                <div class="col-lg-6 col-xl-6 text-center text-lg-start">
                    <div class="hero-badge-wrapper mb-3">
                        <div class="hero-badge-pill">
                            <i class="bi bi-journal-bookmark-fill fs-6"></i>
                            <span>Penerimaan Mahasiswa Baru 2026</span>
                        </div>
                    </div>

                    <h1 class="hero-main-title mb-3">
                        Computer Based Test <span class="hero-title-gradient">(CBT)</span>
                    </h1>

                    <div class="hero-subheading mb-3">
                        Seleksi Penerimaan Mahasiswa Baru<br>
                        <span class="text-ucic-primary">Universitas Catur Insan Cendekia</span>
                    </div>

                    <p class="hero-description mb-4 mx-auto mx-lg-0">
                        Selamat datang di sistem Computer Based Test PMB UCIC.
                        Silakan mengisi data peserta untuk memulai ujian secara online dengan mudah, cepat, dan aman.
                    </p>

                    <div class="hero-cta-buttons d-flex flex-column flex-sm-row align-items-center justify-content-center justify-content-lg-start gap-3">
                        <a href="{{ url('/student/form') }}" class="btn btn-hero-primary btn-ripple w-100 w-sm-auto">
                            <span>Mulai Ujian</span>
                            <i class="bi bi-arrow-right-circle-fill fs-5 btn-arrow-icon"></i>
                        </a>
                        <a href="#info-section" class="btn btn-hero-secondary btn-ripple w-100 w-sm-auto">
                            <i class="bi bi-info-circle-fill"></i>
                            <span>Informasi Ujian</span>
                        </a>
                    </div>
                </div>

                <!-- RIGHT COLUMN: MODERN UNIVERSITY ILLUSTRATION -->
                <div class="col-lg-6 col-xl-6">
                    <div class="illustration-wrapper">
                        <!-- Soft Blue Radial Glow Background -->
                        <div class="illustration-ambient-glow"></div>

                        <!-- Floating Interactive UI Cards Around Main Illustration -->
                        
                        <!-- Floating Card 1: Study & Exam Status -->
                        <div class="floating-ui-card floating-ui-card-1">
                            <div class="bg-primary text-white rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                                <i class="bi bi-mortarboard-fill fs-5"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block" style="font-size: 0.7rem; line-height: 1;">PMB UCIC 2026</small>
                                <strong style="font-size: 0.82rem; color: #1E293B;">Seleksi Online Aktif</strong>
                            </div>
                        </div>

                        <!-- Floating Card 2: Students Studying Badge -->
                        <div class="floating-ui-card floating-ui-card-2">
                            <div class="bg-success text-white rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                                <i class="bi bi-laptop-fill fs-5"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block" style="font-size: 0.7rem; line-height: 1;">Sistem CBT Real-time</small>
                                <strong class="text-success" style="font-size: 0.82rem;"><i class="bi bi-check-circle-fill me-1"></i>Aman & Terenkripsi</strong>
                            </div>
                        </div>

                        <!-- Floating Card 3: Books & Graduation Cap -->
                        <div class="floating-ui-card floating-ui-card-3">
                            <div class="bg-warning text-dark rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                                <i class="bi bi-journal-check fs-5"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block" style="font-size: 0.7rem; line-height: 1;">Format Soal</small>
                                <strong style="font-size: 0.82rem; color: #1E293B;">50 Pilihan Ganda</strong>
                            </div>
                        </div>

                        <!-- Main Glassmorphism Illustration Canvas -->
                        <div class="illustration-main-card">
                            <div class="d-flex align-items-center justify-content-between pb-3 mb-3 border-bottom">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="bg-ucic-light p-2 rounded-3 text-ucic-primary">
                                        <i class="bi bi-bank2 fs-4"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold m-0" style="font-size: 0.95rem; color: #005BAC;">Universitas Catur Insan Cendekia</h6>
                                        <small class="text-muted" style="font-size: 0.75rem;">Portal Resmi Seleksi CBT</small>
                                    </div>
                                </div>
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1" style="font-size: 0.72rem; font-weight: 600;">
                                    <i class="bi bi-circle-fill me-1" style="font-size: 0.5rem;"></i> Portal Aktif
                                </span>
                            </div>

                            <!-- SVG Isometric University & Student Learning Scene -->
                            <div class="text-center py-2 px-1">
                                <svg viewBox="0 0 450 280" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-100 h-auto" style="max-height: 230px;">
                                    <!-- Base Shadow -->
                                    <ellipse cx="225" cy="250" rx="190" ry="20" fill="#005BAC" fill-opacity="0.06"/>
                                    
                                    <!-- University Building Icon/Facade -->
                                    <g transform="translate(145, 20)">
                                        <!-- Roof Triangle -->
                                        <path d="M80 30 L150 75 L10 75 Z" fill="url(#buildingGrad)" />
                                        <!-- Pillars -->
                                        <rect x="25" y="75" width="16" height="80" rx="3" fill="#005BAC" fill-opacity="0.85"/>
                                        <rect x="55" y="75" width="16" height="80" rx="3" fill="#005BAC" fill-opacity="0.85"/>
                                        <rect x="85" y="75" width="16" height="80" rx="3" fill="#005BAC" fill-opacity="0.85"/>
                                        <rect x="115" y="75" width="16" height="80" rx="3" fill="#005BAC" fill-opacity="0.85"/>
                                        <!-- Base Structure -->
                                        <rect x="10" y="155" width="140" height="15" rx="4" fill="#003768"/>
                                        <!-- Central Emblem Circle -->
                                        <circle cx="80" cy="58" r="12" fill="#FFC107"/>
                                        <path d="M76 58 L84 58 M80 54 L80 62" stroke="#005BAC" stroke-width="2.5" stroke-linecap="round"/>
                                    </g>

                                    <!-- Student Laptop & Screen Visual -->
                                    <g transform="translate(40, 120)">
                                        <!-- Laptop Screen Base -->
                                        <rect x="15" y="15" width="130" height="90" rx="10" fill="#1E293B"/>
                                        <rect x="22" y="22" width="116" height="76" rx="6" fill="#F7FAFF"/>
                                        <!-- Laptop Screen UI Elements -->
                                        <rect x="30" y="32" width="50" height="8" rx="4" fill="#005BAC"/>
                                        <rect x="30" y="46" width="100" height="6" rx="3" fill="#E2E8F0"/>
                                        <rect x="30" y="56" width="85" height="6" rx="3" fill="#E2E8F0"/>
                                        <rect x="30" y="66" width="65" height="6" rx="3" fill="#2F80ED"/>
                                        <circle cx="120" cy="36" r="6" fill="#10B981"/>
                                        <!-- Keyboard Base -->
                                        <path d="M0 105 L160 105 L150 120 L10 120 Z" fill="#94A3B8"/>
                                    </g>

                                    <!-- Stack of Books & Graduation Cap -->
                                    <g transform="translate(290, 130)">
                                        <!-- Book 1 (Blue) -->
                                        <rect x="10" y="70" width="110" height="18" rx="4" fill="#005BAC"/>
                                        <rect x="15" y="73" width="100" height="12" rx="2" fill="#EBF4FC"/>
                                        <!-- Book 2 (Secondary Blue) -->
                                        <rect x="15" y="50" width="100" height="18" rx="4" fill="#2F80ED"/>
                                        <rect x="20" y="53" width="90" height="12" rx="2" fill="#FFFFFF"/>
                                        <!-- Book 3 (Accent Yellow) -->
                                        <rect x="25" y="32" width="85" height="16" rx="4" fill="#FFC107"/>
                                        <!-- Graduation Cap on top of books -->
                                        <path d="M65 0 L115 15 L65 30 L15 15 Z" fill="#1E293B"/>
                                        <rect x="45" y="20" width="40" height="12" rx="2" fill="#003768"/>
                                        <!-- Tassel -->
                                        <circle cx="65" cy="15" r="3" fill="#FFC107"/>
                                        <path d="M65 15 L95 24 L95 34" stroke="#FFC107" stroke-width="2" stroke-linecap="round"/>
                                    </g>

                                    <!-- Gradients Definition -->
                                    <defs>
                                        <linearGradient id="buildingGrad" x1="10" y1="30" x2="150" y2="75" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#005BAC"/>
                                            <stop offset="1" stop-color="#2F80ED"/>
                                        </linearGradient>
                                    </defs>
                                </svg>
                            </div>

                            <div class="row g-2 pt-2 border-top">
                                <div class="col-6">
                                    <div class="bg-light p-2 rounded-3 text-center">
                                        <small class="text-muted d-block" style="font-size: 0.7rem;">Metode Seleksi</small>
                                        <strong style="font-size: 0.8rem; color: #005BAC;"><i class="bi bi-cpu me-1"></i>Computer Based</strong>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-light p-2 rounded-3 text-center">
                                        <small class="text-muted d-block" style="font-size: 0.7rem;">Pengumuman</small>
                                        <strong style="font-size: 0.8rem; color: #10B981;"><i class="bi bi-lightning-charge-fill me-1"></i>Hasil Cepat</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <!-- FEATURE CARDS SECTION -->
    <section id="info-section" class="py-5 position-relative" style="z-index: 2;">
        <div class="container">
            <div class="row g-4 justify-content-center">
                
                <!-- CARD 1: LANGKAH 1 -->
                <div class="col-md-4 col-12">
                    <div class="feature-card text-center text-md-start">
                        <div class="feature-icon-wrapper primary mx-auto mx-md-0">
                            <i class="bi bi-person-lines-fill"></i>
                        </div>
                        <div class="feature-card-stat">Langkah 1</div>
                        <h5 class="feature-card-title">Isi Data Diri Lengkap</h5>
                        <p class="feature-card-desc">
                            Masukkan nama lengkap sesuai ijazah dan asal sekolah Anda (SMA/SMK/MA) pada form yang telah disediakan.
                        </p>
                    </div>
                </div>

                <!-- CARD 2: LANGKAH 2 -->
                <div class="col-md-4 col-12">
                    <div class="feature-card text-center text-md-start">
                        <div class="feature-icon-wrapper secondary mx-auto mx-md-0">
                            <i class="bi bi-journal-bookmark-fill"></i>
                        </div>
                        <div class="feature-card-stat">Langkah 2</div>
                        <h5 class="feature-card-title">Pilih Program Studi</h5>
                        <p class="feature-card-desc">
                            Tentukan Pilihan Program Studi 1 dan 2 yang Anda minati dari daftar prodi yang tersedia.
                        </p>
                    </div>
                </div>

                <!-- CARD 3: LANGKAH 3 -->
                <div class="col-md-4 col-12">
                    <div class="feature-card text-center text-md-start">
                        <div class="feature-icon-wrapper accent mx-auto mx-md-0">
                            <i class="bi bi-laptop"></i>
                        </div>
                        <div class="feature-card-stat">Langkah 3</div>
                        <h5 class="feature-card-title">Lanjut ke Ujian</h5>
                        <p class="feature-card-desc">
                            Setelah data dipastikan benar, klik tombol lanjut untuk membaca petunjuk dan segera memulai ujian CBT.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>

<!-- FOOTER -->
<footer class="bg-white border-top py-4 mt-auto position-relative w-100" style="z-index: 10;">
    <div class="container">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between text-center text-md-start gap-3">
            <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-3 flex-wrap flex-sm-nowrap">
                <img src="{{ asset('images/logo-ucic.png') }}" alt="UCIC Logo" style="height: 36px; width: auto; object-fit: contain;">
                <div>
                    <strong class="d-block text-ucic-primary" style="font-size: 0.92rem;">Universitas Catur Insan Cendekia (UCIC)</strong>
                    <small class="text-muted d-block" style="font-size: 0.76rem;">Sistem Computer Based Test (CBT) Penerimaan Mahasiswa Baru</small>
                </div>
            </div>
            <div class="text-center text-md-end">
                <span class="text-muted small" style="font-size: 0.78rem;">&copy; {{ date('Y') }} PMB UCIC. All Rights Reserved.</span>
            </div>
        </div>
    </div>
</footer>
@endsection
