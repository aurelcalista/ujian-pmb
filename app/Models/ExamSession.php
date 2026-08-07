<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamSession extends Model
{
    protected $table = 'exam_sessions';

    protected $fillable = [
        'participant_id',
        'exam_id',
        'started_at',
        'finished_at',
        'status',
        'question_order',
        'option_order',
        'violation_count',
        'security_status',
        'score',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
        'question_order' => 'array',
        'option_order' => 'array',
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class, 'participant_id');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    public function answers()
    {
        return $this->hasMany(ParticipantAnswer::class, 'session_id');
    }

    public function logs()
    {
        return $this->hasMany(ExamActivityLog::class, 'session_id');
    }
}
