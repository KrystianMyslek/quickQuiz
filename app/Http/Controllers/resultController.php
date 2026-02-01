<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Result;
use App\Models\Solution;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class resultController extends Controller
{

    public function index(Request $request)
    {
        $quizes = Quiz::when($request->search, function($query) use ($request) {
            $query
            ->where('user_id', '!=', $request->user()->id)
            ->where(function(Builder $query) use ($request) {
                $query
                ->where('name', 'LIKE', '%'.$request->search.'%')
                ->orWhereHas('category', function($query) use ($request) {
                    $query->where('name', 'LIKE', '%'.$request->search.'%');
                });
            });
        })
        ->where('user_id', '!=', $request->user()->id)
        ->with(['category', 'user', 'result'])
        ->whereHas('result')
        ->withCount('questions')
        ->paginate(10)
        ->withQueryString();

        foreach ($quizes as &$quiz) {
            $quiz->questions_score = $quiz->questionsScore();
        }

        return inertia('result/index', [
            'quizes' => $quizes,
            'searchTerm' => $request->search ?? ""
        ]);
    }

    public function solution(Request $request, $id)
    {
        $result = Result::where('id', $id)->where('user_id', $request->user()->id)->get()->first();
        $solutions = Solution::where('result_id', $result->id)->get()->keyBy('question_id');
        
        $quiz = Quiz::with(['questions.goodAnswer', 'questions.answers'])->where('id', $result->quiz_id)->get()->first();
        $quiz->questions_score = $quiz->questionsScore();

        return inertia('result/solution', [
            'quiz' => $quiz,
            'result' => $result,
            'solutions' => $solutions,
        ]);
    }

}