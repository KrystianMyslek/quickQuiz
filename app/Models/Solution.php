<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'result_id',
        'question_id',
        'answer_id',
    ];
}
