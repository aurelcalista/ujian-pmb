<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = 'exams';

    protected $fillable = [
        'title',
        'description',
        'start_time',
        'end_time',
        'duration',
        'shuffle_questions',
        'shuffle_options',
        'fullscreen_enabled',
        'autosave_enabled',
        'anti_cheat_enabled',
        'max_violation',
        'status',
        'study_program_id',
    ];

    protected $casts = [
        'shuffle_questions' => 'boolean',
        'shuffle_options' => 'boolean',
        'fullscreen_enabled' => 'boolean',
        'autosave_enabled' => 'boolean',
        'anti_cheat_enabled' => 'boolean',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class, 'exam_id');
    }

    public function studyProgram()
    {
        return $this->belongsTo(StudyProgram::class, 'study_program_id');
    }

    public function participants()
    {
        return $this->hasMany(Participant::class, 'exam_id');
    }

    public function sessions()
    {
        return $this->hasMany(ExamSession::class, 'exam_id');
    }
}
