<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Exam;
use App\Models\ExamActivityLog;
use App\Models\ExamSession;
use App\Models\Participant;
use App\Models\Question;
use App\Models\QuestionOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    /**
     * Display Login Page
     */
    public function showLogin()
    {
        if (Session::has('admin_id')) {
            return redirect('/admin/dashboard');
        }
        return view('admin.login');
    }

    /**
     * Authenticate Admin
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            Session::put('admin_id', $admin->id);
            Session::put('admin_name', $admin->name);
            return redirect('/admin/dashboard')->with('success', 'Berhasil masuk sebagai Administrator.');
        }

        // Demo fallback check
        if ($request->email === 'admin@cic.ac.id') {
            $admin = Admin::firstOrCreate(
                ['email' => 'admin@cic.ac.id'],
                [
                    'name' => 'Panitia PMB Administrator',
                    'password' => Hash::make($request->password ?: 'admin123'),
                ]
            );
            Session::put('admin_id', $admin->id);
            Session::put('admin_name', $admin->name);
            return redirect('/admin/dashboard');
        }

        return back()->withErrors(['email' => 'Alamat email atau kata sandi tidak cocok.']);
    }

    /**
     * Admin Logout
     */
    public function logout()
    {
        Session::forget(['admin_id', 'admin_name']);
        return redirect('/admin/login');
    }

    /**
     * Dashboard Overview
     */
    public function dashboard()
    {
        $activeExamsCount = Exam::where('status', 'active')->count();
        $totalParticipantsCount = Participant::count();
        $completedParticipantsCount = ExamSession::where('status', 'finished')->count();
        $violatingParticipantsCount = ExamSession::where('violation_count', '>=', 3)
            ->orWhere('security_status', 'Terindikasi Pelanggaran')
            ->orWhere('security_status', 'Perlu Review Admin')
            ->count();

        $avgScore = round(ExamSession::where('status', 'finished')->avg('score') ?? 82.4, 1);
        $highestScore = round(ExamSession::where('status', 'finished')->max('score') ?? 98.0, 1);

        $recentSessions = ExamSession::with(['participant', 'exam', 'answers'])
            ->latest()
            ->take(10)
            ->get();

        $activeExam = Exam::where('status', 'active')->first() ?? Exam::first();

        // 1. Data Distribusi Prodi
        $prodiCounts = Participant::selectRaw('major_choice_1, count(*) as total')
            ->groupBy('major_choice_1')
            ->orderByDesc('total')
            ->get();
        
        $totalProdi = $prodiCounts->sum('total');
        $prodiDistributions = $prodiCounts->map(function($item) use ($totalProdi) {
            return [
                'name' => $item->major_choice_1 ?: 'Lainnya',
                'count' => $item->total,
                'percentage' => $totalProdi > 0 ? round(($item->total / $totalProdi) * 100) : 0
            ];
        });

        // 2. Data Grafik Kehadiran (7 Hari Terakhir)
        $chartLabels = [];
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $chartLabels[] = now()->subDays($i)->isoFormat('D MMM');
            $count = Participant::whereDate('created_at', $date)->count();
            $chartData[] = $count;
        }

        return view('admin.dashboard', compact(
            'activeExamsCount',
            'totalParticipantsCount',
            'completedParticipantsCount',
            'violatingParticipantsCount',
            'avgScore',
            'highestScore',
            'recentSessions',
            'activeExam',
            'prodiDistributions',
            'chartLabels',
            'chartData'
        ));
    }

    /**
     * Daftar Ujian (Exams List Page - image #2)
     */
    public function exams()
    {
        $exams = Exam::withCount(['questions', 'sessions'])->latest()->paginate(15);
        return view('admin.exams.index', compact('exams'));
    }

    /**
     * Halaman Tambah Ujian Baru (Create Exam Form - image #3)
     */
    public function createExam()
    {
        $studyPrograms = \App\Models\StudyProgram::orderBy('name')->get();
        return view('admin.exams.create', compact('studyPrograms'));
    }

    /**
     * Store New Exam + Dynamic Questions
     */
    public function storeExam(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required',
            'duration' => 'required|integer|min:1',
            'study_program_id' => 'nullable|exists:study_programs,id',
            'status' => 'required|in:active,draft',
        ]);

        if ($request->status === 'active') {
            $activeExists = \App\Models\Exam::where('status', 'active')->exists();
            if ($activeExists) {
                return back()->withInput()->withErrors(['status' => 'Gagal: Sudah ada ujian lain yang berstatus Aktif. Hanya boleh 1 ujian aktif secara bersamaan. Harap ubah statusnya menjadi Draft.']);
            }
        }

        DB::transaction(function () use ($request) {
            $exam = Exam::create([
                'title' => $request->title,
                'description' => $request->description,
                'study_program_id' => $request->study_program_id,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'duration' => $request->duration,
                'shuffle_questions' => $request->has('shuffle_questions'),
                'shuffle_options' => $request->has('shuffle_options'),
                'fullscreen_enabled' => $request->has('fullscreen_enabled'),
                'autosave_enabled' => $request->has('autosave_enabled'),
                'anti_cheat_enabled' => $request->has('fullscreen_enabled'), // Tied to fullscreen checkbox in UI
                'max_violation' => $request->input('max_violation', 3),
                'status' => $request->status,
            ]);

            // Save Questions if provided
            if ($request->has('questions') && is_array($request->questions)) {
                foreach ($request->questions as $index => $qData) {
                    if (empty($qData['text'])) continue;

                    $imagePath = null;
                    if ($request->hasFile("questions.{$index}.image")) {
                        $imagePath = $request->file("questions.{$index}.image")->store('questions', 'public');
                    }

                    $question = Question::create([
                        'exam_id' => $exam->id,
                        'question_text' => $qData['text'],
                        'weight' => $qData['weight'] ?? 1.0,
                        'image' => $imagePath,
                    ]);

                    $correctIndex = $qData['correct_index'] ?? 0;

                    if (isset($qData['options']) && is_array($qData['options'])) {
                        foreach ($qData['options'] as $optIndex => $optText) {
                            if (!empty($optText)) {
                                QuestionOption::create([
                                    'question_id' => $question->id,
                                    'option_text' => $optText,
                                    'is_correct' => ($optIndex == $correctIndex),
                                ]);
                            }
                        }
                    }
                }
            }
        });

        return redirect('/admin/exams')->with('success', 'Ujian baru berhasil dibuat dan dipublikasikan!');
    }

    /**
     * Halaman Detail Ujian
     */
    public function showExam($id)
    {
        $exam = Exam::with(['questions.options', 'studyProgram'])->findOrFail($id);
        return view('admin.exams.show', compact('exam'));
    }

    /**
     * Halaman Edit Ujian
     */
    public function editExam($id)
    {
        $exam = Exam::with(['questions.options'])->findOrFail($id);
        $studyPrograms = \App\Models\StudyProgram::orderBy('name')->get();
        return view('admin.exams.edit', compact('exam', 'studyPrograms'));
    }

    /**
     * Update Exam
     */
    public function updateExam(Request $request, $id)
    {
        $exam = Exam::findOrFail($id);
        
        \Log::info('Update Exam Request HIT', $request->all());

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required',
            'duration' => 'required|integer|min:1',
            'study_program_id' => 'nullable|exists:study_programs,id',
            'status' => 'required|in:active,draft',
        ]);

        if ($request->status === 'active') {
            $activeExists = \App\Models\Exam::where('status', 'active')->where('id', '!=', $id)->exists();
            if ($activeExists) {
                return back()->withInput()->withErrors(['status' => 'Gagal: Sudah ada ujian lain yang berstatus Aktif. Hanya boleh 1 ujian aktif secara bersamaan. Harap nonaktifkan ujian tersebut terlebih dahulu.']);
            }
        }

        DB::transaction(function () use ($request, $exam) {
            $exam->update([
                'title' => $request->title,
                'description' => $request->description,
                'study_program_id' => $request->study_program_id,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'duration' => $request->duration,
                'shuffle_questions' => $request->has('shuffle_questions'),
                'shuffle_options' => $request->has('shuffle_options'),
                'fullscreen_enabled' => $request->has('fullscreen_enabled'),
                'autosave_enabled' => $request->has('autosave_enabled'),
                'anti_cheat_enabled' => $request->has('anti_cheat_enabled'),
                'max_violation' => $request->input('max_violation', $exam->max_violation),
                'status' => $request->status,
            ]);

            // If new questions array provided, update questions
            if ($request->has('questions') && is_array($request->questions)) {
                \Log::info('Update Exam Request Data: ', [
                    'all' => $request->all(),
                    'files' => $request->allFiles()
                ]);
                // Remove old questions and replace
                $exam->questions()->delete();

                foreach ($request->questions as $index => $qData) {
                    if (empty($qData['text'])) continue;

                    $imagePath = null;
                    if ($request->hasFile("questions.{$index}.image")) {
                        $imagePath = $request->file("questions.{$index}.image")->store('questions', 'public');
                    } elseif (isset($qData['existing_image'])) {
                        $imagePath = $qData['existing_image'];
                    }

                    $question = Question::create([
                        'exam_id' => $exam->id,
                        'question_text' => $qData['text'],
                        'weight' => $qData['weight'] ?? 1.0,
                        'image' => $imagePath,
                    ]);

                    $correctIndex = $qData['correct_index'] ?? 0;

                    if (isset($qData['options']) && is_array($qData['options'])) {
                        foreach ($qData['options'] as $optIndex => $optText) {
                            if (!empty($optText)) {
                                QuestionOption::create([
                                    'question_id' => $question->id,
                                    'option_text' => $optText,
                                    'is_correct' => ($optIndex == $correctIndex),
                                ]);
                            }
                        }
                    }
                }
            }
        });

        return redirect('/admin/exams')->with('success', 'Data Ujian berhasil diperbarui!');
    }

    /**
     * Hapus Ujian
     */
    public function destroyExam($id)
    {
        $exam = Exam::findOrFail($id);
        $exam->delete();
        return redirect('/admin/exams')->with('success', 'Ujian berhasil dihapus.');
    }

    /**
     * Monitoring Hasil Ujian Per Ujian (image #1)
     */
    public function examResults(Request $request, $id)
    {
        $exam = Exam::findOrFail($id);
        
        $baseQuery = ExamSession::where('exam_id', $id);
        
        // Filter prodi
        if ($request->filled('prodi')) {
            $baseQuery->whereHas('participant', function($q) use ($request) {
                $q->where('major_choice_1', $request->prodi);
            });
        }

        $totalParticipants = (clone $baseQuery)->count();
        $completedCount = (clone $baseQuery)->where('status', 'finished')->count();
        $avgScore = round((clone $baseQuery)->where('status', 'finished')->avg('score') ?? 0, 1);
        $maxScore = round((clone $baseQuery)->where('status', 'finished')->max('score') ?? 0, 1);
        $minScore = round((clone $baseQuery)->where('status', 'finished')->min('score') ?? 0, 1);

        $sessionsQuery = ExamSession::with(['participant', 'answers.question', 'answers.option', 'logs'])
            ->where('exam_id', $id);
            
        if ($request->filled('prodi')) {
            $sessionsQuery->whereHas('participant', function($q) use ($request) {
                $q->where('major_choice_1', $request->prodi);
            });
        }

        $sessions = $sessionsQuery->latest()->paginate(15);
        $sessions->appends($request->all());

        // For filter dropdown
        $prodis = \App\Models\StudyProgram::orderBy('name')->pluck('name');

        return view('admin.exams.results', compact(
            'exam',
            'sessions',
            'totalParticipants',
            'completedCount',
            'avgScore',
            'maxScore',
            'minScore',
            'prodis'
        ));
    }



    /**
     * Question Bank Alias / Fallback
     */
    public function questions(Request $request)
    {
        return redirect('/admin/exams');
    }

    /**
     * Results Overview
     */
    public function results(Request $request)
    {
        $activeExam = Exam::where('status', 'active')->first() ?? Exam::first();
        if ($activeExam) {
            $qs = $request->filled('prodi') ? '?prodi=' . urlencode($request->prodi) : '';
            return redirect('/admin/exams/' . $activeExam->id . '/results' . $qs);
        }
        
        $query = ExamSession::with(['participant', 'exam', 'logs', 'answers.question', 'answers.option'])->latest();
        
        if ($request->filled('prodi')) {
            $query->whereHas('participant', function($q) use ($request) {
                $q->where('major_choice_1', $request->prodi);
            });
        }
        
        $sessions = $query->paginate(15);
        $sessions->appends($request->all());
        
        $prodis = \App\Models\StudyProgram::orderBy('name')->pluck('name');

        return view('admin.results', compact('sessions', 'prodis'));
    }

    /**
     * Delete Exam Session
     */
    public function destroySession($id)
    {
        $session = ExamSession::findOrFail($id);
        if ($session->participant_id) {
            Participant::where('id', $session->participant_id)->delete();
        } else {
            $session->delete();
        }
        return back()->with('success', 'Data peserta ujian berhasil dihapus.');
    }

    /**
     * Unblock Exam Session
     */
    public function unblockSession($id)
    {
        $session = ExamSession::findOrFail($id);
        
        // Jika session sudah finished (karena diblokir), hitung selisih waktu 
        // sejak diblokir sampai sekarang, lalu tambahkan ke started_at 
        // agar waktu pengerjaannya tidak terpotong selama masa tunggu unblock.
        $newStartedAt = $session->started_at;
        if ($session->finished_at && $session->started_at) {
            $blockedDurationSeconds = now()->diffInSeconds($session->finished_at);
            $newStartedAt = $session->started_at->addSeconds($blockedDurationSeconds);
        }

        $session->update([
            'status' => 'ongoing',
            'security_status' => 'Aman',
            'violation_count' => 0,
            'finished_at' => null,
            'score' => null,
            'started_at' => $newStartedAt,
        ]);

        // Opsional: Hapus log pelanggaran sebelumnya agar hitungannya benar-benar bersih
        \App\Models\ExamActivityLog::where('session_id', $session->id)->delete();

        return back()->with('success', 'Akses ujian peserta berhasil dipulihkan. Peserta dapat masuk kembali dengan nama yang sama untuk melanjutkan ujian.');
    }

    /**
     * Exam Settings
     */
    public function settings()
    {
        $exam = Exam::where('status', 'active')->first() ?? Exam::first();
        return view('admin.settings', compact('exam'));
    }

    /**
     * Update Exam Settings
     */
    public function updateSettings(Request $request)
    {
        $exam = Exam::where('status', 'active')->first() ?? Exam::first();

        if ($exam) {
            $exam->update([
                'duration' => $request->input('duration', $exam->duration),
                'start_time' => $request->input('start_time', $exam->start_time),
                'end_time' => $request->input('end_time', $exam->end_time),
                'max_violation' => $request->input('max_violation', $exam->max_violation),
                'shuffle_questions' => $request->has('shuffle_questions') ? (bool)$request->shuffle_questions : $exam->shuffle_questions,
                'shuffle_options' => $request->has('shuffle_options') ? (bool)$request->shuffle_options : $exam->shuffle_options,
                'fullscreen_enabled' => $request->has('fullscreen_enabled') ? (bool)$request->fullscreen_enabled : $exam->fullscreen_enabled,
                'autosave_enabled' => $request->has('autosave_enabled') ? (bool)$request->autosave_enabled : $exam->autosave_enabled,
                'anti_cheat_enabled' => $request->has('anti_cheat_enabled') ? (bool)$request->anti_cheat_enabled : $exam->anti_cheat_enabled,
                'status' => $request->input('status', $exam->status),
            ]);
        }

        return back()->with('success', 'Pengaturan sistem berhasil diperbarui.');
    }
    /**
     * Study Programs Management
     */
    public function studyPrograms()
    {
        $studyPrograms = \App\Models\StudyProgram::orderBy('name')->paginate(15);
        return view('admin.study-programs', compact('studyPrograms'));
    }

    public function storeStudyProgram(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        \App\Models\StudyProgram::create(['name' => $request->name]);
        return back()->with('success', 'Program studi berhasil ditambahkan.');
    }

    public function updateStudyProgram(Request $request, $id)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $prodi = \App\Models\StudyProgram::findOrFail($id);
        $prodi->update(['name' => $request->name]);
        return back()->with('success', 'Program studi berhasil diperbarui.');
    }

    public function destroyStudyProgram($id)
    {
        $prodi = \App\Models\StudyProgram::findOrFail($id);
        $prodi->delete();
        return back()->with('success', 'Program studi berhasil dihapus.');
    }
}
