<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $table = 'participants';

    protected $fillable = [
        'exam_id',
        'name',
        'school_origin',
        'major_choice_1',
        'major_choice_2',
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    public function sessions()
    {
        return $this->hasMany(ExamSession::class, 'participant_id');
    }

    public function activeSession()
    {
        return $this->hasOne(ExamSession::class, 'participant_id')->latestOfMany();
    }
}
