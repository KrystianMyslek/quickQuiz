<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Quiz extends Model
{
    protected $table = 'quizes';

    protected $fillable = [
        'name',
        'category_id',
        'user_id',
    ];

    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'quiz_id', 'id');
    }

    // public static function procesCreateForm($fields)
    // {
    //     $quiz_fields = [
    //         'name' => $fields['name'],
    //         'category_id' => $fields['category']->id,
    //         'user_id' => $fields['user_id'],
    //     ];

    //     $quiz = self::create($quiz_fields);

    //     foreach ($fields['questions'] as $question_fields) {
    //         $question = Question::create([
    //             'quiz_id' => $quiz->id,
    //             'content' => $question_fields['content'],
    //             'time_to_answer' => $question_fields['time_to_answer'],
    //             'score' => $question_fields['score'],
    //             'good_answer_id' => null,
    //         ]);

    //         foreach ($question_fields['answers'] as $answer_index => $answer_fields) {
    //             $answer = Answer::create([
    //                 'question_id' => $question->id,
    //                 'content' => $answer_fields['content'],
    //             ]);

    //             if ($answer_index == $question_fields['good_answer']['id']) {
    //                 $question->good_answer_id = $answer->id;
    //                 $question->save();
    //             }
    //         }
    //     }

    //     return $quiz;
    // }

    // public static function procesUpdateForm($fields, $quiz)
    // {

    // }
}
