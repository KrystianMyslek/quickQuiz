<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Solution;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class resultController extends Controller
{

    public function index(Request $request)
    {
        $results = Result::when($request->search, function($query) use ($request) {
            $query
            ->where('user_id', $request->user()->id)
            ->where(function(Builder $query) use ($request) {
                $query
                ->whereHas('quiz', function($query) use ($request) {
                    $query->where('name', 'LIKE', '%'.$request->search.'%')
                    ->orWhereHas('category', function($query) use ($request) {
                        $query->where('name', 'LIKE', '%'.$request->search.'%');
                    });
                });
            });
        })
        ->where('user_id', $request->user()->id)
        ->with([
            'user',
            'quiz' => function($query) {
                $query
                ->withCount('questions')
                ->withSum('questions', 'score')
                ->withTrashed();
            },
            'quiz.category',
        ])
        ->paginate(10)
        ->withQueryString();

        return inertia('result/index', [
            'results' => $results,
            'searchTerm' => $request->search ?? ""
        ]);
    }

    public function solution(Request $request, $id)
    {
        $result = Result::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->with([
                'solutions',
                'quiz' => function($query) {
                    $query
                    ->withCount('questions')
                    ->withSum('questions', 'score')
                    ->with(['questions', 'questions.goodAnswer', 'questions.answers'])
                    ->withTrashed();
                } 
            ])
            ->first();

       if ($result->solutions->count() != $result->quiz->questions->count()) {
            foreach ($result->quiz->questions as $question) {
                $solutions = $result->solutions->keyBy('question_id');
                if (!isset($solutions[$question->id])) {
                    $solution = new Solution([
                        'result_id' => $result->id,
                        'question_id' => $question->id,
                        'answer_id' => null,
                    ]);

                    $result->solutions->push($solution);
                }
            }
        }

        return inertia('result/solution', [
            'result' => $result
        ]);
    }

}