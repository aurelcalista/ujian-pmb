<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamActivityLog;
use App\Models\ExamSession;
use App\Models\Participant;
use App\Models\ParticipantAnswer;
use App\Models\Question;
use App\Models\QuestionOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
    /**
     * Landing Page
     */
    public function landing()
    {
        $exam = Exam::where('status', 'active')->first() ?? Exam::first();
        return view('student.landing', compact('exam'));
    }

    /**
     * Show Participant Biodata Form
     */
    public function showForm()
    {
        $exam = Exam::where('status', 'active')->first() ?? Exam::first();
        $studyPrograms = \App\Models\StudyProgram::orderBy('name')->get();
        return view('student.participant-form', compact('exam', 'studyPrograms'));
    }

    /**
     * Store Participant Biodata
     */
    public function storeForm(Request $request)
    {
        $request->validate([
            'fullName' => 'required|string|max:255',
            'schoolOrigin' => 'required|string|max:255',
            'majorChoice1' => 'required|string',
            'majorChoice2' => 'required|string',
        ]);

        $studyProgram = \App\Models\StudyProgram::where('name', $request->majorChoice1)->first();
        $exam = null;

        if ($studyProgram) {
            $exam = Exam::where('status', 'active')
                ->where('study_program_id', $studyProgram->id)
                ->first();
        }
        
        // Fallback ke ujian yang tidak ditujukan ke prodi tertentu (berlaku untuk semua)
        if (!$exam) {
            $exam = Exam::where('status', 'active')
                ->whereNull('study_program_id')
                ->first();
        }

        if (!$exam) {
            return back()->withErrors(['msg' => 'Ujian untuk program studi ini belum tersedia saat ini.']);
        }

        // Check if participant already exists for this exam
        $existingParticipant = Participant::where('name', $request->fullName)
            ->where('school_origin', $request->schoolOrigin)
            ->where('exam_id', $exam->id)
            ->first();

        if ($existingParticipant) {
            $session = ExamSession::where('participant_id', $existingParticipant->id)->latest()->first();
            
            if ($session && $session->status === 'finished') {
                return back()->withInput()->withErrors(['fullName' => 'Data Anda tercatat sudah menyelesaikan ujian ini. Anda tidak diperkenankan mengikuti ujian lebih dari satu kali.']);
            }
            
            // If ongoing or no session, use existing participant to resume
            $participant = $existingParticipant;
            
            // Update major choice just in case they changed it
            $participant->update([
                'major_choice_1' => $request->majorChoice1,
                'major_choice_2' => $request->majorChoice2
            ]);
        } else {
            $participant = Participant::create([
                'exam_id' => $exam->id,
                'name' => $request->fullName,
                'school_origin' => $request->schoolOrigin,
                'major_choice_1' => $request->majorChoice1,
                'major_choice_2' => $request->majorChoice2,
            ]);
        }

        Session::put('participant_id', $participant->id);
        Session::put('exam_id', $exam->id);

        return redirect('/student/info');
    }

    /**
     * Show Exam Instructions Page
     */
    public function showInfo()
    {
        $participantId = Session::get('participant_id');
        $examId = Session::get('exam_id');

        if (!$participantId || !$examId) {
            return redirect('/student/form');
        }

        $participant = Participant::findOrFail($participantId);
        $exam = Exam::findOrFail($examId);
        $questionsCount = Question::where('exam_id', $exam->id)->count();

        $now = now();
        $isExamStarted = $exam->start_time ? $now->greaterThanOrEqualTo($exam->start_time) : true;
        $isExamEnded = $exam->end_time ? $now->greaterThan($exam->end_time) : false;

        return view('student.exam-info', compact('participant', 'exam', 'questionsCount', 'isExamStarted', 'isExamEnded'));
    }

    /**
     * Initialize / Start Exam Session
     */
    public function startExam()
    {
        $participantId = Session::get('participant_id');
        $examId = Session::get('exam_id');

        if (!$participantId || !$examId) {
            return redirect('/student/form');
        }

        $participant = Participant::findOrFail($participantId);
        $exam = Exam::findOrFail($examId);

        $now = now();
        $isExamStarted = $exam->start_time ? $now->greaterThanOrEqualTo($exam->start_time) : true;
        $isExamEnded = $exam->end_time ? $now->greaterThan($exam->end_time) : false;

        if (!$isExamStarted) {
            return back()->with('error', 'Ujian belum dimulai. Harap tunggu hingga waktu ujian tiba.');
        }

        if ($isExamEnded) {
            return back()->with('error', 'Waktu ujian telah berakhir. Anda tidak dapat memulai ujian.');
        }

        // Find existing session or create new one
        $session = ExamSession::where('participant_id', $participantId)
            ->where('exam_id', $examId)
            ->where('status', 'ongoing')
            ->first();

        if (!$session) {
            // Get all question IDs for this exam
            $questionIds = Question::where('exam_id', $exam->id)
                ->pluck('id')
                ->toArray();

            if ($exam->shuffle_questions) {
                shuffle($questionIds);
            }

            // Map option order for each question
            $optionOrderMap = [];
            foreach ($questionIds as $qId) {
                $optIds = QuestionOption::where('question_id', $qId)
                    ->pluck('id')
                    ->toArray();
                if ($exam->shuffle_options) {
                    shuffle($optIds);
                }
                $optionOrderMap[$qId] = $optIds;
            }

            $session = ExamSession::create([
                'participant_id' => $participantId,
                'exam_id' => $examId,
                'started_at' => now(),
                'status' => 'ongoing',
                'question_order' => $questionIds,
                'option_order' => $optionOrderMap,
                'violation_count' => 0,
                'security_status' => 'Aman',
            ]);
        }

        Session::put('exam_session_id', $session->id);

        return redirect('/student/exam');
    }

    /**
     * Render Exam Pengerjaan Page
     */
    public function showExam()
    {
        $sessionId = Session::get('exam_session_id');

        if (!$sessionId) {
            $participantId = Session::get('participant_id');
            if ($participantId) {
                $session = ExamSession::where('participant_id', $participantId)
                    ->where('status', 'ongoing')
                    ->latest()
                    ->first();
                if ($session) {
                    $sessionId = $session->id;
                    Session::put('exam_session_id', $sessionId);
                } else {
                    return redirect('/student/info');
                }
            } else {
                return redirect('/student/form');
            }
        }

        $session = ExamSession::with(['participant', 'exam'])->findOrFail($sessionId);

        if ($session->status === 'finished') {
            return redirect('/student/thank-you');
        }

        $exam = $session->exam;
        $participant = $session->participant;

        // Compute Remaining Seconds
        $durationSeconds = $exam->duration * 60;
        $elapsedSeconds = now()->diffInSeconds($session->started_at, false);
        $elapsedSeconds = abs($elapsedSeconds);
        $remainingSeconds = max(0, $durationSeconds - $elapsedSeconds);

        if ($remainingSeconds <= 0 && $session->status === 'ongoing') {
            // Auto finish if time expired
            $this->finalizeSession($session);
            return redirect('/student/thank-you');
        }

        // Fetch ordered questions & options
        $questionOrder = $session->question_order ?? [];
        $optionOrderMap = $session->option_order ?? [];

        $questionsRaw = Question::with('options')
            ->whereIn('id', $questionOrder)
            ->get()
            ->keyBy('id');

        // Reconstruct ordered questions and ordered options
        $orderedQuestions = [];
        foreach ($questionOrder as $qId) {
            if (isset($questionsRaw[$qId])) {
                $q = $questionsRaw[$qId];
                $optIds = $optionOrderMap[$qId] ?? [];
                if (!empty($optIds)) {
                    $optsRaw = $q->options->keyBy('id');
                    $orderedOpts = collect();
                    foreach ($optIds as $oId) {
                        if (isset($optsRaw[$oId])) {
                            $orderedOpts->push($optsRaw[$oId]);
                        }
                    }
                    $q->setRelation('options', $orderedOpts);
                }
                $orderedQuestions[] = $q;
            }
        }

        // Fetch existing saved answers for this session
        $savedAnswers = ParticipantAnswer::where('session_id', $session->id)
            ->get()
            ->keyBy('question_id');

        return view('student.exam-page', compact(
            'session',
            'exam',
            'participant',
            'remainingSeconds',
            'orderedQuestions',
            'savedAnswers'
        ));
    }

    /**
     * AJAX Auto Save Answer
     */
    public function autosaveAnswer(Request $request)
    {
        $request->validate([
            'session_id' => 'required|exists:exam_sessions,id',
            'question_id' => 'required|exists:questions,id',
            'option_id' => 'nullable|exists:question_options,id',
            'is_doubt' => 'nullable|boolean',
        ]);

        $session = ExamSession::findOrFail($request->session_id);

        if ($session->status === 'finished') {
            return response()->json(['success' => false, 'message' => 'Ujian telah selesai.'], 400);
        }

        $answer = ParticipantAnswer::updateOrCreate(
            [
                'session_id' => $session->id,
                'question_id' => $request->question_id,
            ],
            [
                'option_id' => $request->option_id,
                'is_doubt' => $request->boolean('is_doubt'),
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Jawaban berhasil tersimpan.',
            'timestamp' => now()->format('H:i:s'),
        ]);
    }

    /**
     * AJAX Log Anti-Cheat Violation
     */
    public function logViolation(Request $request)
    {
        $request->validate([
            'session_id' => 'required|exists:exam_sessions,id',
            'activity_type' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $session = ExamSession::findOrFail($request->session_id);
        $exam = $session->exam;

        if ($session->status === 'finished') {
            return response()->json(['success' => true, 'violation_count' => $session->violation_count]);
        }

        $newCount = $session->violation_count + 1;
        $session->violation_count = $newCount;

        if ($newCount >= $exam->max_violation) {
            $session->security_status = 'Terindikasi Pelanggaran / Diblokir';
        } else if ($newCount > 0) {
            $session->security_status = 'Mendapat Peringatan';
        }
        $session->save();

        ExamActivityLog::create([
            'session_id' => $session->id,
            'activity_type' => $request->activity_type,
            'description' => $request->description ?: "Terdeteksi aktivitas {$request->activity_type}",
            'violation_number' => $newCount,
        ]);

        if ($newCount >= $exam->max_violation) {
            $this->finalizeSession($session);
            Session::forget(['participant_id', 'exam_id', 'exam_session_id']);
            return response()->json([
                'success' => true,
                'violation_count' => $newCount,
                'blocked' => true
            ]);
        }

        return response()->json([
            'success' => true,
            'violation_count' => $newCount,
            'max_violation' => $exam->max_violation,
            'security_status' => $session->security_status,
            'blocked' => false
        ]);
    }

    /**
     * Submit Exam (Finished)
     */
    public function submitExam(Request $request)
    {
        $sessionId = $request->input('session_id', Session::get('exam_session_id'));

        if (!$sessionId) {
            return redirect('/student/thank-you');
        }

        $session = ExamSession::findOrFail($sessionId);

        if ($session->status !== 'finished') {
            $this->finalizeSession($session);
        }

        Session::forget(['participant_id', 'exam_id', 'exam_session_id']);

        return redirect('/student/thank-you');
    }

    /**
     * Thank You Page
     */
    public function thankYou()
    {
        return view('student.thank-you');
    }

    /**
     * Blocked Page
     */
    public function blocked()
    {
        return view('student.blocked');
    }

    /**
     * Helper to Calculate Score & Finalize Session
     */
    protected function finalizeSession(ExamSession $session)
    {
        $exam = $session->exam;
        $questions = Question::with('options')->where('exam_id', $exam->id)->get();
        $totalWeight = $questions->sum('weight');
        
        $answers = ParticipantAnswer::where('session_id', $session->id)
            ->with('option')
            ->get()
            ->keyBy('question_id');

        $earnedWeight = 0;

        foreach ($questions as $q) {
            if (isset($answers[$q->id])) {
                $ans = $answers[$q->id];
                if ($ans->option && $ans->option->is_correct) {
                    $earnedWeight += $q->weight;
                }
            }
        }

        $score = ($totalWeight > 0) ? ($earnedWeight / $totalWeight) * 100 : 0;

        $session->update([
            'finished_at' => now(),
            'status' => 'finished',
            'score' => round($score, 2),
        ]);
    }
}
