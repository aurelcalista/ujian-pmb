<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParticipantAnswer extends Model
{
    protected $table = 'participant_answers';

    protected $fillable = [
        'session_id',
        'question_id',
        'option_id',
        'is_doubt',
    ];

    protected $casts = [
        'is_doubt' => 'boolean',
    ];

    public function session()
    {
        return $this->belongsTo(ExamSession::class, 'session_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function option()
    {
        return $this->belongsTo(QuestionOption::class, 'option_id');
    }
}
