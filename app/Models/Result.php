<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'quiz_id',
        'score',
        'good_answers_count',
        'created_at',
    ];
}
