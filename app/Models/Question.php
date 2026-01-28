<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Question extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'quiz_id',
        'content',
        'time_to_answer',
        'score',
        'good_answer_id',
    ];

    public function goodAnswer(): HasOne
    {
        return $this->hasOne(Answer::class, 'good_answer_id');
    }
}
