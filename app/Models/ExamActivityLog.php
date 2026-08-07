<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamActivityLog extends Model
{
    protected $table = 'exam_activity_logs';

    protected $fillable = [
        'session_id',
        'activity_type',
        'description',
        'violation_number',
    ];

    public function session()
    {
        return $this->belongsTo(ExamSession::class, 'session_id');
    }
}
