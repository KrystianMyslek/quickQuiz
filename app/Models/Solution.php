<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Solution extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'result_id',
        'question_id',
        'answer_id',
    ];

    public function result() : BelongsTo
    {
        return $this->belongsTo(Result::class, 'result_id', 'id');
    }

    public function question() : BelongsTo
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }

    public function answer() : BelongsTo
    {
        return $this->belongsTo(Answer::class, 'answer_id', 'id');
    }
    
}
