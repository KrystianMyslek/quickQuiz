<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    protected $table = 'categories';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'image',
    ];

    public function quizes() : BelongsTo
    {
        return $this->belongsTo(Quiz::class, 'category_id', 'id');
    }
}
