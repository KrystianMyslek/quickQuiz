<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function quiz() : BelongsTo
    {
        return $this->belongsTo(Quiz::class, 'quiz_id', 'id');
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function solutions() : HasMany
    {
        return $this->hasMany(Solution::class, 'result_id', 'id');
    }
}
