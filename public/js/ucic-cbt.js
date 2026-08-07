/**
 * UNIVERSITAS CATUR INSAN CENDEKIA (UCIC) - CBT UI INTERACTIVE SCRIPT
 */

document.addEventListener('DOMContentLoaded', function () {

    // ----------------------------------------------------------------------
    // 1. OPTION CARD SELECTION (PAGE 4 EXAM)
    // ----------------------------------------------------------------------
    const optionCards = document.querySelectorAll('.option-card');

    optionCards.forEach(card => {
        card.addEventListener('click', function () {
            // Find parent question container or current context
            const radio = this.querySelector('input[type="radio"]');
            if (radio) {
                radio.checked = true;
            }

            // Remove selected class from siblings
            const parent = this.closest('.options-container') || this.parentElement;
            if (parent) {
                parent.querySelectorAll('.option-card').forEach(sibling => {
                    sibling.classList.remove('selected');
                });
            }

            // Add selected class to clicked card
            this.classList.add('selected');

            // Trigger auto-save feedback & update active navigation button state
            triggerAutoSave();
            updateQuestionNavStatus(getCurrentQuestionIndex(), 'answered');
        });
    });

    // ----------------------------------------------------------------------
    // 2. FLAG QUESTION TOGGLE (RAGU-RAGU)
    // ----------------------------------------------------------------------
    const flagBtn = document.getElementById('btnFlagQuestion');
    if (flagBtn) {
        flagBtn.addEventListener('click', function () {
            this.classList.toggle('active');
            const isFlagged = this.classList.contains('active');
            if (isFlagged) {
                this.classList.remove('btn-outline-warning');
                this.classList.add('btn-warning');
            } else {
                this.classList.remove('btn-warning');
                this.classList.add('btn-outline-warning');
            }
            updateQuestionNavStatus(getCurrentQuestionIndex(), isFlagged ? 'flagged' : 'unflagged');
        });
    }

    // ----------------------------------------------------------------------
    // 3. EXAM TIMER COUNTDOWN
    // ----------------------------------------------------------------------
    const timerElement = document.getElementById('cbtTimerDisplay');
    if (timerElement) {
        let totalSeconds = 90 * 60; // 90 minutes default

        const timerInterval = setInterval(function () {
            if (totalSeconds <= 0) {
                clearInterval(timerInterval);
                timerElement.textContent = "00:00:00";
                // Submit exam automatically
                const finishModalEl = document.getElementById('finishModal');
                if (finishModalEl && window.bootstrap) {
                    const finishModal = new bootstrap.Modal(finishModalEl);
                    finishModal.show();
                }
                return;
            }

            totalSeconds--;

            const hours = Math.floor(totalSeconds / 3600);
            const minutes = Math.floor((totalSeconds % 3600) / 60);
            const seconds = totalSeconds % 60;

            const formattedTime =
                String(hours).padStart(2, '0') + ':' +
                String(minutes).padStart(2, '0') + ':' +
                String(seconds).padStart(2, '0');

            timerElement.textContent = formattedTime;

            // Timer color warnings
            if (totalSeconds < 300) { // < 5 mins
                timerElement.classList.add('danger');
                timerElement.classList.remove('warning');
            } else if (totalSeconds < 900) { // < 15 mins
                timerElement.classList.add('warning');
            }
        }, 1000);
    }

    // ----------------------------------------------------------------------
    // 4. AUTO SAVE INDICATOR LOGIC
    // ----------------------------------------------------------------------
    function triggerAutoSave() {
        const autoSaveText = document.getElementById('autoSaveText');
        if (autoSaveText) {
            const now = new Date();
            const timeStr = now.toTimeString().split(' ')[0];
            autoSaveText.textContent = `Tersimpan otomatis ${timeStr}`;
        }
    }

    function getCurrentQuestionIndex() {
        const activeNavBtn = document.querySelector('.cbt-num-btn.active');
        return activeNavBtn ? activeNavBtn.getAttribute('data-index') || '1' : '1';
    }

    function updateQuestionNavStatus(index, status) {
        const btn = document.querySelector(`.cbt-num-btn[data-index="${index}"]`);
        if (!btn) return;

        if (status === 'answered') {
            btn.classList.add('answered');
        } else if (status === 'flagged') {
            btn.classList.add('flagged');
        } else if (status === 'unflagged') {
            btn.classList.remove('flagged');
        }
    }

    // Question Nav Grid Buttons Click
    const numBtns = document.querySelectorAll('.cbt-num-btn');
    numBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            numBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            const qNum = this.getAttribute('data-index');
            const qTitle = document.getElementById('currentQuestionTitle');
            if (qTitle) {
                qTitle.textContent = `Soal No. ${qNum}`;
            }
        });
    });

    // ----------------------------------------------------------------------
    // 5. DEMO PROTOTYPE SWITCHER (For viewing all pages effortlessly)
    // ----------------------------------------------------------------------
    const demoBtns = document.querySelectorAll('[data-demo-target]');
    demoBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            const targetId = this.getAttribute('data-demo-target');
            
            // Hide all demo page sections
            document.querySelectorAll('.demo-page-section').forEach(sec => {
                sec.classList.add('d-none');
            });

            // Show target section
            const targetSec = document.getElementById(targetId);
            if (targetSec) {
                targetSec.classList.remove('d-none');
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }

            // Update active state in top bar
            demoBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // ----------------------------------------------------------------------
    // 6. CHART.JS INITIALIZATION FOR ADMIN DASHBOARD
    // ----------------------------------------------------------------------
    const chartCanvas = document.getElementById('participantChart');
    if (chartCanvas && typeof Chart !== 'undefined') {
        const ctx = chartCanvas.getContext('2d');
        
        let labels = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        let dataCounts = [42, 65, 88, 120, 95, 145, 180];
        
        if (window.cbtChartData) {
            labels = window.cbtChartData.labels;
            dataCounts = window.cbtChartData.data;
        }

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Peserta Baru Terdaftar',
                        data: dataCounts,
                        borderColor: '#005BAC',
                        backgroundColor: 'rgba(0, 91, 172, 0.08)',
                        fill: true,
                        tension: 0.4,
                        borderWidth: 3,
                        pointBackgroundColor: '#005BAC',
                        pointRadius: 5
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: { family: 'Poppins', size: 12 },
                            usePointStyle: true
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#F1F5F9' },
                        ticks: { font: { family: 'Poppins' } }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { family: 'Poppins' } }
                    }
                }
            }
        });
    }

    // ----------------------------------------------------------------------
    // 7. NAVBAR SCROLL EFFECT
    // ----------------------------------------------------------------------
    const navbar = document.querySelector('.ucic-navbar');
    if (navbar) {
        window.addEventListener('scroll', function () {
            if (window.scrollY > 20) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        });
    }

});

function toggleAdminSidebar() {
    const sidebar = document.getElementById('adminSidebar');
    const main = document.querySelector('.admin-main');
    let backdrop = document.getElementById('sidebarBackdrop');

    if (!backdrop) {
        backdrop = document.createElement('div');
        backdrop.id = 'sidebarBackdrop';
        backdrop.className = 'sidebar-backdrop';
        backdrop.onclick = toggleAdminSidebar;
        document.body.appendChild(backdrop);
    }

    if (!sidebar) return;

    if (window.innerWidth < 992) {
        sidebar.classList.toggle('show-mobile');
        sidebar.classList.toggle('show');
        backdrop.classList.toggle('show');
    } else {
        sidebar.classList.toggle('collapsed');
        if (main) main.classList.toggle('expanded');
    }
}

// ----------------------------------------------------------------------
// GLOBAL DARK / LIGHT MODE TOGGLE
// ----------------------------------------------------------------------
function toggleTheme() {
    const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
    const newTheme = currentTheme === 'light' ? 'dark' : 'light';
    setTheme(newTheme);
}

function setTheme(theme) {
    document.documentElement.setAttribute('data-theme', theme);
    localStorage.setItem('ucic_theme', theme);

    const themeIcons = document.querySelectorAll('.theme-toggle-icon');
    themeIcons.forEach(icon => {
        if (theme === 'dark') {
            icon.className = 'bi bi-sun-fill fs-5 text-warning theme-toggle-icon';
        } else {
            icon.className = 'bi bi-moon-stars-fill fs-5 text-muted theme-toggle-icon';
        }
    });
}

// Auto init theme state
(function initTheme() {
    const savedTheme = localStorage.getItem('ucic_theme') || 'light';
    setTheme(savedTheme);
})();


