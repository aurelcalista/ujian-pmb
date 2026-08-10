@extends('layouts.app')

@section('title', 'CBT Ujian PMB - ' . ($exam->title ?? 'Universitas Catur Insan Cendekia'))

@section('content')
<!-- TOP CBT HEADER -->
<header class="cbt-header">
    <div class="container-fluid px-md-4">
        <div class="d-flex align-items-center justify-content-between">
            
            <!-- Left: Logo & Exam Title -->
            <div class="d-flex align-items-center gap-3">
                <img src="{{ asset('images/logo-ucic.png') }}" alt="UCIC Logo" class="ucic-logo-img-sm">
                <div class="d-none d-md-block border-start ps-3">
                    <h6 class="fw-bold text-ucic-primary m-0" style="font-size: 0.92rem; line-height: 1.2;">{{ $exam->title ?? 'CBT PMB UCIC 2026/2027' }}</h6>
                    <small class="text-muted" style="font-size: 0.75rem;">Peserta: {{ $participant->name }} ({{ $participant->school_origin }})</small>
                </div>
            </div>

            <!-- Center: Auto Save & Violation Counter Status -->
            <div class="d-flex align-items-center gap-3">
                <div class="auto-save-indicator bg-light px-3 py-1.5 rounded-pill border d-none d-lg-flex">
                    <span class="auto-save-dot"></span>
                    <span id="autoSaveText">Tersimpan otomatis</span>
                </div>

                <div id="violationCounterContainer">
                    <span class="badge bg-warning-subtle text-dark border border-warning px-2 px-md-3 py-1 py-md-1.5 rounded-pill fw-bold" style="font-size: 0.82rem;">
                        <i class="bi bi-shield-exclamation text-warning me-0 me-sm-1"></i> 
                        <span class="d-none d-sm-inline">Pelanggaran: </span><span id="violationCountDisplay">{{ $session->violation_count }}</span>/{{ $exam->max_violation }}
                    </span>
                </div>
            </div>

            <!-- Right: Timer & Mobile Navigation Toggle -->
            <div class="d-flex align-items-center gap-2 gap-md-3">
                <div class="cbt-timer px-2 px-md-3" id="cbtTimerDisplay">
                    <i class="bi bi-clock-history"></i>
                    <span id="timerText" class="d-none d-sm-inline">00:00:00</span>
                    <span id="timerTextMobile" class="d-inline d-sm-none" style="font-size: 0.85rem;">00:00</span>
                </div>
                <button class="btn btn-outline-primary d-lg-none px-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#cbtSidebarOffcanvas">
                    <i class="bi bi-grid-3x3-gap-fill fs-5"></i>
                </button>
            </div>
        </div>
    </div>
</header>

<!-- MAIN EXAM LAYOUT -->
<div class="container-fluid px-md-4 my-4 flex-grow-1">
    <div class="row g-4">
        
        <!-- LEFT / MAIN QUESTION PANEL -->
        <div class="col-lg-8 col-xl-9">
            <div class="ucic-card h-100 d-flex flex-column" id="mainQuestionCard">
                
                <!-- Question Card Header -->
                <div class="ucic-card-header d-flex flex-wrap align-items-center justify-content-between gap-3 bg-light">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-ucic-primary px-2 px-md-3 py-1 py-md-2 fs-6 rounded-pill" id="currentQuestionTitle">Soal No. 1</span>
                        <span class="text-muted small">dari {{ count($orderedQuestions) }} Soal</span>
                    </div>

                    <button type="button" class="btn btn-sm btn-outline-warning fw-semibold px-3 rounded-pill" id="btnFlagQuestion">
                        <i class="bi bi-flag-fill"></i> <span class="d-none d-sm-inline ms-1">Tandai Ragu-ragu</span>
                    </button>
                </div>

                <!-- Question Text & Options Body -->
                <div class="ucic-card-body flex-grow-1 p-4 p-md-5">
                    <div class="question-text mb-4" id="questionTextContainer" style="font-size: 1.05rem; line-height: 1.7; color: var(--ucic-text-dark);">
                        <!-- Question content dynamically rendered via JS -->
                    </div>

                    <!-- ANSWER OPTIONS CONTAINER -->
                    <div class="options-container space-y-3" id="optionsContainer">
                        <!-- Options dynamically rendered via JS -->
                    </div>
                </div>

                <!-- Bottom Question Navigation Toolbar -->
                <div class="p-3 p-md-4 border-top bg-light d-flex flex-wrap align-items-center justify-content-between gap-2 rounded-bottom-4">
                    <button class="btn btn-outline-secondary px-3 px-md-4 py-2 fw-semibold rounded-3" id="btnPrevQuestion">
                        <i class="bi bi-chevron-left"></i> <span class="d-none d-sm-inline ms-1">Sebelumnya</span>
                    </button>

                    <div class="d-flex align-items-center gap-2 ms-auto">
                        <button class="btn btn-ucic-secondary px-3 px-md-4 py-2 fw-semibold rounded-3" id="btnNextQuestion">
                            <span class="d-none d-sm-inline me-1">Selanjutnya</span> <i class="bi bi-chevron-right"></i>
                        </button>

                        <button class="btn btn-success px-3 px-md-4 py-2 fw-semibold rounded-3 d-none text-nowrap" id="btnFinishTrigger" data-bs-toggle="modal" data-bs-target="#finishModal">
                            <i class="bi bi-check-circle-fill me-1"></i> Selesai Ujian
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT QUESTION NAVIGATION SIDEBAR (Desktop) -->
        <div class="col-lg-4 col-xl-3 d-none d-lg-block">
            <div class="ucic-card h-100">
                <div class="ucic-card-header bg-ucic-primary text-white" style="border-radius: 18px 18px 0 0; background: linear-gradient(135deg, #005BAC 0%, #004685 100%);">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-white text-ucic-primary fw-bold d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="bi bi-person-fill fs-5"></i>
                        </div>
                        <div class="text-truncate">
                            <h6 class="fw-bold m-0 text-white text-truncate" style="font-size: 0.92rem;">{{ $participant->name }}</h6>
                            <small class="text-white-50 text-truncate d-block" style="font-size: 0.72rem;">{{ $participant->school_origin }}</small>
                        </div>
                    </div>
                </div>

                <div class="ucic-card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6 class="fw-bold m-0 text-dark">Navigasi Soal</h6>
                        <small class="badge bg-light text-muted border">{{ count($orderedQuestions) }} Soal</small>
                    </div>

                    <!-- Question Grid -->
                    <div class="cbt-num-grid mb-4" id="desktopNumGrid">
                        <!-- Buttons rendered via JS -->
                    </div>

                    <!-- Legend -->
                    <div class="border-top pt-3 space-y-2" style="font-size: 0.82rem;">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="d-flex align-items-center gap-2">
                                <span class="legend-dot answered"></span> Sudah Dijawab
                            </span>
                            <strong class="text-ucic-primary" id="legendAnsweredCount">0 Soal</strong>
                        </div>

                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="d-flex align-items-center gap-2">
                                <span class="legend-dot flagged"></span> Ragu-ragu
                            </span>
                            <strong class="text-warning" id="legendFlaggedCount">0 Soal</strong>
                        </div>

                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="d-flex align-items-center gap-2">
                                <span class="legend-dot unanswered"></span> Belum Dijawab
                            </span>
                            <strong class="text-muted" id="legendUnansweredCount">0 Soal</strong>
                        </div>

                        <div class="d-flex align-items-center justify-content-between">
                            <span class="d-flex align-items-center gap-2">
                                <span class="legend-dot active"></span> Soal Aktif
                            </span>
                            <strong class="text-dark" id="legendActiveQuestionText">No. 1</strong>
                        </div>
                    </div>

                    <div class="mt-4 pt-2">
                        <button class="btn btn-success w-100 py-2.5 fw-semibold rounded-3" data-bs-toggle="modal" data-bs-target="#finishModal">
                            <i class="bi bi-check-circle-fill me-1"></i> Selesai Ujian
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- MOBILE OFFCANVAS QUESTION NAV SIDEBAR -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="cbtSidebarOffcanvas" aria-labelledby="cbtSidebarOffcanvasLabel">
    <div class="offcanvas-header bg-ucic-primary text-white">
        <h5 class="offcanvas-title fw-bold fs-6" id="cbtSidebarOffcanvasLabel">Navigasi Soal Ujian</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-3">
        <div class="cbt-num-grid mb-4" id="mobileNumGrid">
            <!-- Rendered via JS -->
        </div>
        <button class="btn btn-success w-100 py-2.5 fw-semibold rounded-3" data-bs-toggle="modal" data-bs-target="#finishModal" data-bs-dismiss="offcanvas">
            <i class="bi bi-check-circle-fill me-1"></i> Selesai Ujian
        </button>
    </div>
</div>

<!-- ANTI-CHEAT ALARM WARNING MODAL -->
<div class="modal fade" id="warningModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg" style="border-top: 5px solid #EF4444 !important;">
            <div class="modal-body p-4 p-md-5 text-center">
                <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle bg-danger-subtle text-danger" style="width: 72px; height: 72px;">
                    <i class="bi bi-exclamation-triangle-fill" style="font-size: 2.5rem;"></i>
                </div>
                <h4 class="fw-bold mb-2 text-danger" id="warningModalTitle">⚠️ PERINGATAN 1/3</h4>
                <p class="text-secondary mb-4" id="warningModalBody" style="line-height: 1.6; font-size: 0.95rem;">
                    Anda terdeteksi meninggalkan halaman ujian. Mohon kembali fokus mengerjakan. Aktivitas telah dicatat.
                </p>
                <button type="button" class="btn btn-danger w-100 py-3 fw-bold fs-6 rounded-3" id="btnAcknowledgeWarning">
                    <i class="bi bi-shield-check me-1"></i> Saya Mengerti & Kembali Ujian
                </button>
            </div>
        </div>
    </div>
</div>

<!-- FINISH EXAM CONFIRMATION MODAL -->
<div class="modal fade" id="finishModal" tabindex="-1" aria-labelledby="finishModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-body p-4 p-md-5 text-center">
                <div class="stat-icon primary mx-auto mb-3" style="width: 64px; height: 64px; font-size: 2rem;">
                    <i class="bi bi-question-circle-fill"></i>
                </div>
                <h4 class="fw-bold mb-2">Konfirmasi Selesai Ujian</h4>
                <p class="text-secondary mb-4 small" style="line-height: 1.6;">
                    Apakah Anda yakin ingin menyelesaikan ujian sekarang? Pastikan seluruh soal telah dijawab sebelum mengirimkan.
                </p>

                <div class="row g-2 mb-4 text-start bg-light p-3 rounded-3" style="font-size: 0.88rem;">
                    <div class="col-6">Sudah Dijawab: <strong class="text-success" id="modalSummaryAnswered">0 Soal</strong></div>
                    <div class="col-6">Ragu-ragu: <strong class="text-warning" id="modalSummaryFlagged">0 Soal</strong></div>
                    <div class="col-6">Belum Dijawab: <strong class="text-danger" id="modalSummaryUnanswered">0 Soal</strong></div>
                    <div class="col-6">Sisa Waktu: <strong class="text-primary" id="modalSummaryTimer">00:00:00</strong></div>
                </div>

                <form action="{{ url('/student/submit') }}" method="POST" id="finishExamForm">
                    @csrf
                    <input type="hidden" name="session_id" value="{{ $session->id }}">
                    <div class="d-flex gap-3">
                        <button type="button" class="btn btn-light w-50 py-2.5 fw-semibold" data-bs-dismiss="modal">Kembali Pengerjaan</button>
                        <button type="submit" class="btn btn-ucic-primary w-50 py-2.5 fw-semibold">
                            Ya, Tetap Selesaikan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- IMAGE ZOOM MODAL -->
<div class="modal fade" id="imageZoomModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-header border-0 pb-0 position-absolute w-100 justify-content-end" style="z-index: 10;">
                <button type="button" class="btn-close btn-close-white m-2" data-bs-dismiss="modal" aria-label="Close" style="background-color: rgba(0,0,0,0.5); border-radius: 50%; padding: 0.5rem;"></button>
            </div>
            <div class="modal-body text-center p-0 mt-4">
                <img src="" id="zoomedImage" class="img-fluid rounded shadow-lg bg-white" style="max-height: 85vh; object-fit: contain;">
            </div>
        </div>
    </div>
</div>
<!-- FULLSCREEN ENTRY OVERLAY -->
<div id="fullscreenEntryOverlay" class="position-fixed top-0 start-0 w-100 h-100 bg-white d-none flex-column align-items-center justify-content-center" style="z-index: 9999;">
    <div class="text-center p-4">
        <div class="mb-4 text-ucic-primary" style="font-size: 4rem;">
            <i class="bi bi-laptop"></i>
        </div>
        <h3 class="fw-bold mb-2">Siap Mengerjakan Ujian?</h3>
        <p class="text-secondary mb-4" style="max-width: 400px; margin: 0 auto;">
            Sistem membutuhkan izin Layar Penuh (Fullscreen) untuk mengaktifkan fitur Anti-Cheat. Pastikan Anda tidak keluar dari layar penuh selama ujian berlangsung.
        </p>
        <button type="button" class="btn btn-ucic-primary btn-lg px-5 py-3 fw-bold shadow" id="btnEnterExamFullscreen" style="border-radius: 12px;">
            <i class="bi bi-arrows-fullscreen me-2"></i> Masuk Ujian (Fullscreen)
        </button>
    </div>
</div>
@endsection


@push('scripts')
<script>
// EXAM DATA PASSED FROM LARAVEL BACKEND
window.CBT_EXAM_CONFIG = {
    sessionId: {{ $session->id }},
    maxViolation: {{ $exam->max_violation ?? 3 }},
    violationCount: {{ $session->violation_count ?? 0 }},
    remainingSeconds: {{ $remainingSeconds }},
    autosaveEnabled: {{ $exam->autosave_enabled ? 'true' : 'false' }},
    antiCheatEnabled: {{ $exam->anti_cheat_enabled ? 'true' : 'false' }},
    sessionDuration: {{ $exam->duration * 60 }},
    questions: [
        @foreach($orderedQuestions as $index => $q)
        {
            id: {{ $q->id }},
            number: {{ $index + 1 }},
            text: `{!! addslashes($q->question_text) !!}`,
            image: `{!! $q->image ? asset('storage/' . $q->image) : '' !!}`,
            weight: {{ $q->weight }},
            savedOptionId: {{ isset($savedAnswers[$q->id]) && $savedAnswers[$q->id]->option_id ? $savedAnswers[$q->id]->option_id : 'null' }},
            isDoubt: {{ isset($savedAnswers[$q->id]) && $savedAnswers[$q->id]->is_doubt ? 'true' : 'false' }},
            options: [
                @foreach($q->options as $optIdx => $opt)
                {
                    id: {{ $opt->id }},
                    key: "{{ chr(65 + $optIdx) }}",
                    text: `{!! addslashes($opt->option_text) !!}`
                }@if(!$loop->last),@endif
                @endforeach
            ]
        }@if(!$loop->last),@endif
        @endforeach
    ]
};

// INITIALIZE INTERACTIVE CBT EXAM ENGINE
document.addEventListener('DOMContentLoaded', function () {
    const config = window.CBT_EXAM_CONFIG;
    let currentIndex = 0;
    let timerSeconds = config.remainingSeconds;
    let warningAudioCtx = null;

    // Web Audio Synthesizer Alarm Generator
    function playAlarmSound() {
        try {
            if (!warningAudioCtx) {
                warningAudioCtx = new (window.AudioContext || window.webkitAudioContext)();
            }
            const osc = warningAudioCtx.createOscillator();
            const gain = warningAudioCtx.createGain();
            osc.type = 'sawtooth';
            osc.frequency.setValueAtTime(880, warningAudioCtx.currentTime); // A5 note
            osc.frequency.exponentialRampToValueAtTime(440, warningAudioCtx.currentTime + 0.5);
            gain.gain.setValueAtTime(0.3, warningAudioCtx.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.01, warningAudioCtx.currentTime + 0.5);
            osc.connect(gain);
            gain.connect(warningAudioCtx.destination);
            osc.start();
            osc.stop(warningAudioCtx.currentTime + 0.5);
        } catch (e) {
            console.log("Audio play allowed after user interaction.");
        }
    }

    // Fullscreen Enforcer
    function requestFullscreenMode() {
        if (!config.antiCheatEnabled) return;
        const el = document.documentElement;
        if (!document.fullscreenElement && !document.webkitFullscreenElement) {
            if (el.requestFullscreen) {
                el.requestFullscreen().catch((err) => { console.error("Error attempting to enable fullscreen:", err); });
            } else if (el.webkitRequestFullscreen) {
                el.webkitRequestFullscreen();
            }
        }
    }

    // 1. Render Navigation Grids
    function renderNavGrid() {
        const desktopGrid = document.getElementById('desktopNumGrid');
        const mobileGrid = document.getElementById('mobileNumGrid');
        let html = '';
        let answeredCount = 0;
        let flaggedCount = 0;
        let unansweredCount = 0;

        config.questions.forEach((q, idx) => {
            let classes = 'cbt-num-btn';
            if (idx === currentIndex) classes += ' active';
            if (q.savedOptionId) {
                classes += ' answered';
                answeredCount++;
            } else {
                unansweredCount++;
            }
            if (q.isDoubt) {
                classes += ' flagged';
                flaggedCount++;
            }

            html += `<div class="${classes}" onclick="jumpToQuestion(${idx})">${q.number}</div>`;
        });

        if (desktopGrid) desktopGrid.innerHTML = html;
        if (mobileGrid) mobileGrid.innerHTML = html;

        // Update Legend & Summary
        document.getElementById('legendAnsweredCount').textContent = `${answeredCount} Soal`;
        document.getElementById('legendFlaggedCount').textContent = `${flaggedCount} Soal`;
        document.getElementById('legendUnansweredCount').textContent = `${unansweredCount} Soal`;
        document.getElementById('legendActiveQuestionText').textContent = `No. ${currentIndex + 1}`;

        document.getElementById('modalSummaryAnswered').textContent = `${answeredCount} Soal`;
        document.getElementById('modalSummaryFlagged').textContent = `${flaggedCount} Soal`;
        document.getElementById('modalSummaryUnanswered').textContent = `${unansweredCount} Soal`;
    }

    // 2. Render Current Question
    function renderQuestion(index) {
        if (index < 0 || index >= config.questions.length) return;
        currentIndex = index;
        const q = config.questions[currentIndex];

        // Header Title
        document.getElementById('currentQuestionTitle').textContent = `Soal No. ${q.number}`;

        // Question Text Body
        let imageHtml = q.image ? '<div class="mb-3 text-center"><img src="' + q.image + '" alt="Gambar Soal" class="img-fluid rounded border" style="max-height: 250px; cursor: zoom-in;" onclick="openImageZoom(this.src)"></div>' : '';
        document.getElementById('questionTextContainer').innerHTML = imageHtml + `
            <p class="fw-medium mb-3">${q.text}</p>
            <p class="text-secondary small mb-0">Pilihlah salah satu jawaban yang Anda anggap paling benar di bawah ini:</p>
        `;

        // Answer Options
        let optsHtml = '';
        q.options.forEach(opt => {
            const isSelected = q.savedOptionId === opt.id;
            optsHtml += `
                <label class="option-card mb-3 w-100 ${isSelected ? 'selected' : ''}" onclick="selectOption(${q.id}, ${opt.id})">
                    <input type="radio" name="q_${q.id}" value="${opt.id}" ${isSelected ? 'checked' : ''} class="d-none">
                    <div class="option-key">${opt.key}</div>
                    <div class="option-text">${opt.text}</div>
                </label>
            `;
        });
        document.getElementById('optionsContainer').innerHTML = optsHtml;

        // Flag Ragu-ragu Button State
        const flagBtn = document.getElementById('btnFlagQuestion');
        if (q.isDoubt) {
            flagBtn.className = 'btn btn-sm btn-warning fw-semibold px-3 rounded-pill active';
        } else {
            flagBtn.className = 'btn btn-sm btn-outline-warning fw-semibold px-3 rounded-pill';
        }

        // Toolbar Buttons State
        document.getElementById('btnPrevQuestion').disabled = (currentIndex === 0);
        const isLast = (currentIndex === config.questions.length - 1);
        const nextBtn = document.getElementById('btnNextQuestion');
        const finishBtn = document.getElementById('btnFinishTrigger');

        if (isLast) {
            nextBtn.classList.add('d-none');
            finishBtn.classList.remove('d-none');
        } else {
            nextBtn.classList.remove('d-none');
            finishBtn.classList.add('d-none');
        }

        renderNavGrid();
    }

    // Global Option Select Handler with Auto-Save
    window.selectOption = function (questionId, optionId) {
        const q = config.questions[currentIndex];
        q.savedOptionId = optionId;

        renderQuestion(currentIndex);
        triggerAutosave(q.id, optionId, q.isDoubt);
    };

    // Global Jump Handler
    window.jumpToQuestion = function (idx) {
        renderQuestion(idx);
        const offcanvas = bootstrap.Offcanvas.getInstance(document.getElementById('cbtSidebarOffcanvas'));
        if (offcanvas) offcanvas.hide();
    };

    // Global Image Zoom Handler
    window.openImageZoom = function(src) {
        document.getElementById('zoomedImage').src = src;
        const zoomModal = new bootstrap.Modal(document.getElementById('imageZoomModal'));
        zoomModal.show();
    };

    // Prev / Next Listeners
    document.getElementById('btnPrevQuestion').addEventListener('click', () => {
        if (currentIndex > 0) renderQuestion(currentIndex - 1);
    });

    document.getElementById('btnNextQuestion').addEventListener('click', () => {
        if (currentIndex < config.questions.length - 1) renderQuestion(currentIndex + 1);
    });

    // Ragu-ragu Toggle Handler
    document.getElementById('btnFlagQuestion').addEventListener('click', function () {
        const q = config.questions[currentIndex];
        q.isDoubt = !q.isDoubt;
        renderQuestion(currentIndex);
        triggerAutosave(q.id, q.savedOptionId, q.isDoubt);
    });

    // AJAX Auto Save
    function triggerAutosave(questionId, optionId, isDoubt) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        fetch('/student/autosave-answer', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                session_id: config.sessionId,
                question_id: questionId,
                option_id: optionId,
                is_doubt: isDoubt
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const autoSaveEl = document.getElementById('autoSaveText');
                if (autoSaveEl) {
                    autoSaveEl.textContent = `Tersimpan otomatis ${data.timestamp || ''}`;
                }
            }
        })
        .catch(err => console.log('Autosave sync queued locally.'));
    }

    // 3. Timer Countdown Logic
    const timerDisplay = document.getElementById('timerText');
    const timerInterval = setInterval(() => {
        if (timerSeconds <= 0) {
            clearInterval(timerInterval);
            timerDisplay.textContent = '00:00:00';
            document.getElementById('finishExamForm').submit();
            return;
        }
        timerSeconds--;
        const hrs = String(Math.floor(timerSeconds / 3600)).padStart(2, '0');
        const mins = String(Math.floor((timerSeconds % 3600) / 60)).padStart(2, '0');
        const secs = String(Math.floor(timerSeconds % 60)).padStart(2, '0');
        const formatted = `${hrs}:${mins}:${secs}`;

        timerDisplay.textContent = formatted;
        
        const timerDisplayMobile = document.getElementById('timerTextMobile');
        if (timerDisplayMobile) {
            timerDisplayMobile.textContent = `${hrs > 0 ? hrs + ':' : ''}${mins}:${secs}`;
        }
        
        document.getElementById('modalSummaryTimer').textContent = formatted;
    }, 1000);

    // 4. Anti-Cheat & Alarm Warning Popup System
    let isWarningModalOpen = false;
    let alarmInterval = null;
    let sharedAudioCtx = null;

    function playAlarmSound() {
        if (alarmInterval) return; // Already playing

        try {
            const AudioContext = window.AudioContext || window.webkitAudioContext;
            if (!AudioContext) return;
            if (!sharedAudioCtx) sharedAudioCtx = new AudioContext();
            
            function playBeeps() {
                // Create 3 rapid beeps
                for (let i = 0; i < 3; i++) {
                    const oscillator = sharedAudioCtx.createOscillator();
                    const gainNode = sharedAudioCtx.createGain();
                    
                    oscillator.type = 'square';
                    oscillator.frequency.setValueAtTime(800, sharedAudioCtx.currentTime + (i * 0.3));
                    oscillator.frequency.exponentialRampToValueAtTime(1200, sharedAudioCtx.currentTime + (i * 0.3) + 0.1);
                    
                    gainNode.gain.setValueAtTime(0, sharedAudioCtx.currentTime + (i * 0.3));
                    gainNode.gain.linearRampToValueAtTime(0.5, sharedAudioCtx.currentTime + (i * 0.3) + 0.05);
                    gainNode.gain.linearRampToValueAtTime(0, sharedAudioCtx.currentTime + (i * 0.3) + 0.2);
                    
                    oscillator.connect(gainNode);
                    gainNode.connect(sharedAudioCtx.destination);
                    
                    oscillator.start(sharedAudioCtx.currentTime + (i * 0.3));
                    oscillator.stop(sharedAudioCtx.currentTime + (i * 0.3) + 0.2);
                }
            }

            playBeeps();
            alarmInterval = setInterval(playBeeps, 1000);
        } catch (e) {
            console.error("Audio API not supported or blocked");
        }
    }

    function stopAlarmSound() {
        if (alarmInterval) {
            clearInterval(alarmInterval);
            alarmInterval = null;
        }
    }

    function handleViolation(activityType, description) {
        if (!config.antiCheatEnabled || isWarningModalOpen) return;

        // Show Warning Modal Immediately Client-Side
        isWarningModalOpen = true;
        config.violationCount++;
        const vCount = config.violationCount;
        
        document.getElementById('violationCountDisplay').textContent = vCount;
        playAlarmSound();

        const modalTitle = document.getElementById('warningModalTitle');
        const modalBody = document.getElementById('warningModalBody');

        if (vCount < config.maxViolation) {
            modalTitle.textContent = `⚠️ PERINGATAN ${vCount}/${config.maxViolation}`;
            modalBody.textContent = 'Anda terdeteksi meninggalkan halaman ujian atau keluar dari mode fullscreen. Mohon kembali fokus mengerjakan. Aktivitas mencurigakan telah dicatat.';
        } else {
            modalTitle.textContent = '🚨 UJIAN DIBLOKIR KARENA PELANGGARAN';
            modalBody.textContent = 'Batas pelanggaran maksimal telah tercapai. Ujian Anda dihentikan secara paksa, disubmit otomatis, dan dilaporkan kepada Admin Ujian.';
            document.getElementById('btnAcknowledgeWarning').textContent = 'Keluar Ujian';
            document.getElementById('btnAcknowledgeWarning').classList.remove('btn-warning');
            document.getElementById('btnAcknowledgeWarning').classList.add('btn-danger');
        }

        const warningModalEl = document.getElementById('warningModal');
        const modalInstance = new bootstrap.Modal(warningModalEl);
        modalInstance.show();

        // Sync with Server Asynchronously
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        fetch('/student/log-violation', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            keepalive: true, // helps ensure request finishes when backgrounded
            body: JSON.stringify({
                session_id: config.sessionId,
                activity_type: activityType,
                description: description
            })
        }).catch(e => console.log('Network sync delayed'));
    }

    // Acknowledge Warning & Re-enforce Fullscreen
    document.getElementById('btnAcknowledgeWarning').addEventListener('click', () => {
        stopAlarmSound();
        if (config.violationCount >= config.maxViolation) {
            window.location.href = '/student/blocked';
            return;
        }
        isWarningModalOpen = false;
        const warningModalEl = document.getElementById('warningModal');
        const modalInstance = bootstrap.Modal.getInstance(warningModalEl);
        if (modalInstance) modalInstance.hide();
        requestFullscreenMode();
    });

    // Detect Tab Switching & Visibility Change
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            handleViolation('pindah_tab', 'Peserta terdeteksi berpindah tab atau meminimalkan browser');
        }
    });

    // Detect Window Blur / Focus Out
    window.addEventListener('blur', () => {
        handleViolation('window_blur', 'Peserta terdeteksi mengklik luar jendela browser');
    });

    // Detect Fullscreen Exit
    document.addEventListener('fullscreenchange', () => {
        if (!document.fullscreenElement) {
            handleViolation('keluar_fullscreen', 'Peserta terdeteksi keluar dari mode layar penuh (Fullscreen)');
        }
    });

    // Initial Start: Render Q1 & Request Fullscreen
    if (config.questions.length > 0) {
        renderQuestion(0);
    } else {
        document.getElementById('questionTextContainer').innerHTML = '<div class="alert alert-warning">Soal tidak ditemukan. Mungkin soal baru saja ditambahkan setelah Anda mulai ujian. Harap hubungi Admin.</div>';
    }
    
    // Fullscreen Entry Logic (Exambro Style)
    const overlay = document.getElementById('fullscreenEntryOverlay');
    const btnEnter = document.getElementById('btnEnterExamFullscreen');
    
    if (config.antiCheatEnabled) {
        // Show overlay blocking the exam until user clicks to enter fullscreen
        overlay.classList.remove('d-none');
        overlay.classList.add('d-flex');
        
        btnEnter.addEventListener('click', () => {
            requestFullscreenMode();
            overlay.classList.remove('d-flex');
            overlay.classList.add('d-none');
            
            // Initialize AudioContext on this deliberate user gesture
            if (!window.audioCtxInited) {
                try {
                    const AudioContext = window.AudioContext || window.webkitAudioContext;
                    if (AudioContext) {
                        if (!sharedAudioCtx) sharedAudioCtx = new AudioContext();
                        if (sharedAudioCtx.state === 'suspended') {
                            sharedAudioCtx.resume();
                        }
                        const osc = sharedAudioCtx.createOscillator();
                        osc.connect(sharedAudioCtx.destination);
                        osc.start();
                        osc.stop(sharedAudioCtx.currentTime + 0.001);
                        window.audioCtxInited = true;
                    }
                } catch(e){}
            }
        });
    } else {
        // If anti-cheat is disabled, just try to request fullscreen gracefully (will likely be ignored by browser without gesture)
        setTimeout(requestFullscreenMode, 1000);
    }
});
</script>
@endpush
