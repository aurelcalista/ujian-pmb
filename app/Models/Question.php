<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $fillable = [
        'exam_id',
        'question_text',
        'weight',
        'image',
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    public function options()
    {
        return $this->hasMany(QuestionOption::class, 'question_id');
    }

    public function correctOption()
    {
        return $this->hasOne(QuestionOption::class, 'question_id')->where('is_correct', true);
    }
}
