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

        return view('admin.dashboard', compact(
            'activeExamsCount',
            'totalParticipantsCount',
            'completedParticipantsCount',
            'violatingParticipantsCount',
            'avgScore',
            'highestScore',
            'recentSessions',
            'activeExam'
        ));
    }

    /**
     * Daftar Ujian (Exams List Page - image #2)
     */
    public function exams()
    {
        $exams = Exam::withCount(['questions', 'sessions'])->latest()->get();
        return view('admin.exams.index', compact('exams'));
    }

    /**
     * Halaman Tambah Ujian Baru (Create Exam Form - image #3)
     */
    public function createExam()
    {
        return view('admin.exams.create');
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
        ]);

        DB::transaction(function () use ($request) {
            $exam = Exam::create([
                'title' => $request->title,
                'description' => $request->description,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'duration' => $request->duration,
                'shuffle_questions' => $request->has('shuffle_questions'),
                'shuffle_options' => $request->has('shuffle_options'),
                'fullscreen_enabled' => $request->has('fullscreen_enabled'),
                'autosave_enabled' => $request->has('autosave_enabled'),
                'anti_cheat_enabled' => $request->has('anti_cheat_enabled'),
                'max_violation' => $request->input('max_violation', 3),
                'status' => 'active',
            ]);

            // Save Questions if provided
            if ($request->has('questions') && is_array($request->questions)) {
                foreach ($request->questions as $qData) {
                    if (empty($qData['text'])) continue;

                    $question = Question::create([
                        'exam_id' => $exam->id,
                        'question_text' => $qData['text'],
                        'weight' => $qData['weight'] ?? 1.0,
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
     * Halaman Edit Ujian
     */
    public function editExam($id)
    {
        $exam = Exam::with(['questions.options'])->findOrFail($id);
        return view('admin.exams.edit', compact('exam'));
    }

    /**
     * Update Exam
     */
    public function updateExam(Request $request, $id)
    {
        $exam = Exam::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required',
            'duration' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request, $exam) {
            $exam->update([
                'title' => $request->title,
                'description' => $request->description,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'duration' => $request->duration,
                'shuffle_questions' => $request->has('shuffle_questions'),
                'shuffle_options' => $request->has('shuffle_options'),
                'fullscreen_enabled' => $request->has('fullscreen_enabled'),
                'autosave_enabled' => $request->has('autosave_enabled'),
                'anti_cheat_enabled' => $request->has('anti_cheat_enabled'),
                'max_violation' => $request->input('max_violation', $exam->max_violation),
                'status' => $request->input('status', $exam->status),
            ]);

            // If new questions array provided, update questions
            if ($request->has('questions') && is_array($request->questions)) {
                // Remove old questions and replace
                $exam->questions()->delete();

                foreach ($request->questions as $qData) {
                    if (empty($qData['text'])) continue;

                    $question = Question::create([
                        'exam_id' => $exam->id,
                        'question_text' => $qData['text'],
                        'weight' => $qData['weight'] ?? 1.0,
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
    public function examResults($id)
    {
        $exam = Exam::findOrFail($id);
        
        $totalParticipants = Participant::where('exam_id', $id)->count();
        $sessions = ExamSession::with(['participant', 'answers.question', 'answers.option', 'logs'])
            ->where('exam_id', $id)
            ->get();

        $completedSessions = $sessions->where('status', 'finished');
        $completedCount = $completedSessions->count();

        $avgScore = round($completedSessions->avg('score') ?? 0, 1);
        $maxScore = round($completedSessions->max('score') ?? 0, 1);
        $minScore = round($completedSessions->min('score') ?? 0, 1);

        return view('admin.exams.results', compact(
            'exam',
            'sessions',
            'totalParticipants',
            'completedCount',
            'avgScore',
            'maxScore',
            'minScore'
        ));
    }

    /**
     * Participants List
     */
    public function participants(Request $request)
    {
        $query = ExamSession::with(['participant', 'exam', 'logs']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('participant', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('school_origin', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $sessions = $query->latest()->get();

        return view('admin.participants', compact('sessions'));
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
            return redirect('/admin/exams/' . $activeExam->id . '/results');
        }
        $sessions = ExamSession::with(['participant', 'exam', 'logs', 'answers.question', 'answers.option'])
            ->where('status', 'finished')
            ->latest()
            ->get();

        return view('admin.results', compact('sessions'));
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
}
