<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Category;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Result;
use App\Models\Solution;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class quizController extends Controller
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
                })
                ->orWhereHas('user', function($query) use ($request) {
                    $query->where('name', 'LIKE', '%'.$request->search.'%');
                });
            });
        })
        ->where('user_id', '!=', $request->user()->id)
        ->with(['category', 'user', 'result'])
        ->whereDoesntHave('result')
        ->withCount('questions')
        ->paginate(10)
        ->withQueryString();

        return inertia('quiz/index', [
            'quizes' => $quizes,
            'searchTerm' => $request->search ?? ""
        ]);
    }

    public function mylist(Request $request)
    {
        $quizes = Quiz::when($request->search, function($query) use ($request) {
            $query
            ->where('user_id', $request->user()->id)
            ->where(function(Builder $query) use ($request) {
                $query
                ->where('name', 'LIKE', '%'.$request->search.'%')
                ->orWhereHas('category', function($query) use ($request) {
                    $query->where('name', 'LIKE', '%'.$request->search.'%');
                });
            });
        })
        ->where('user_id', $request->user()->id)
        ->with(['category', 'user'])
        ->withCount('questions')
        ->paginate(10)
        ->withQueryString();

        return inertia('quiz/mylist', [
            'quizes' => $quizes,
            'searchTerm' => $request->search ?? ""
        ]);
    }

    public function create()
    {
        Gate::authorize('create', Quiz::class);

        $categories = Category::all();

        return inertia('quiz/create', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        Gate::authorize('create', Quiz::class);

        $fields = $this->validate($request);

        $quiz = new Quiz();
        $quiz->user_id = $request->user()->id;

        $this->processForm($fields, $quiz);

        return redirect()
            ->route('quiz_mylist')
            ->with('message', __('app.quiz.created_successfully'));
    }

    public function edit($id)
    {
        $categories = Category::all();
        $quiz = Quiz::with(['category', 'questions.answers', 'questions.goodAnswer'])->where('id', $id)->get()->first();

        return inertia('quiz/edit', [
            'categories' => $categories,
            'quiz' => $quiz
        ]);
    }

    public function update(Request $request, $id)
    {
        $quiz = Quiz::with(['category', 'questions.answers', 'questions.goodAnswer'])->where('id', $id)->get()->first();

        Gate::authorize('update', [Quiz::class, $quiz]);

        $fields = $this->validate($request);

        $this->processForm($fields, $quiz);

        return redirect()
            ->route('quiz_mylist')
            ->with('message', __('app.quiz.updated_successfully'));
    }

    private function validate(Request $request)
    {
        return Validator::make($request->all(), [
            'name' => ['required', 'max:255'],
            'category.id' => ['required', 'exists:categories,id'],
            'questions' => ['required'],
            'questions.*.content' => ['required', 'string'],
            'questions.*.time_to_answer' => ['required', 'integer', 'min:1'],
            'questions.*.score' => ['required', 'integer', 'min:1'],
            'questions.*.answers.*.content' => ['required', 'string'],
            'questions.*.good_answer.id' => ['required', 'integer'],
        ], [
            'category.id.exists' => __('validation.required', ['attribute' => strtolower(__('app.quiz.category'))]),
            'questions.required' => __('validation.questions.required'),
            'questions.*.content.required' => __('validation.questions.content.required'),
            'questions.*.time_to_answer.required' => __('validation.questions.time_to_answer.required'),
            'questions.*.score.required' => __('validation.questions.score.required'),
            'questions.*.answers.*.content.required' => __('validation.questions.answers.content.required'),
            'questions.*.good_answer.id.required' => __('validation.questions.good_answer.required'),
        ])->validate();
    }

    private function processForm($fields, Quiz $quiz) 
    {
        $quiz->name = $fields['name'];
        $quiz->category_id = $fields['category']['id'];
        $quiz->save();

        foreach ($fields['questions'] as $question_index => $question_fields) {

            if (isset($quiz->questions[$question_index])) {
                $question = $quiz->questions[$question_index];
            } else {
                $question = new Question();
                $question->quiz_id = $quiz->id;
            }

            $question->content = $question_fields['content'];
            $question->time_to_answer = $question_fields['time_to_answer'];
            $question->score = $question_fields['score'];
            $question->good_answer_id = null; // Temporary, will be set later
            $question->save();

            foreach ($question_fields['answers'] as $answer_index => $answer_fields) {

                if (isset($question->answers[$answer_index])) {
                    $answer = $question->answers[$answer_index];
                } else {
                    $answer = new Answer();
                    $answer->question_id = $question->id;
                }

                $answer->content = $answer_fields['content'];
                $answer->save();

                if ($answer->id == $question_fields['good_answer']['id'] || $answer_index == $question_fields['good_answer']['id']) {
                    $question->good_answer_id = $answer->id;
                    $question->save();
                }
            }
        }

        return $quiz;
    }

    public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id);

        Gate::authorize('delete', [Quiz::class, $quiz]);

        $quiz->delete();

        return redirect()
            ->route('quiz_mylist')
            ->with('message', __('app.quiz.deleted_successfully'));
    }

    public function solve($id)
    {
        $quiz = Quiz::with(['category', 'questions.answers'])->where('id', $id)->get()->first();

        return inertia('quiz/solve', [
            'quiz' => $quiz,
        ]);
    }

    public function verification(Request $request, $id)
    {
        $quiz = Quiz::with(['questions.goodAnswer'])->where('id', $id)->get()->first();

        $good_answers_count = 0;
        $achieved_score = 0;
        foreach ($request->solve as $solve) {
            $question = $quiz->questions->where('id', $solve['question_id'])->first();

            if ($question && $question->good_answer_id == $solve['user_answer_id']) {
                $achieved_score += $question->score;
                $good_answers_count++;
            }
        }
        
        $result = Result::create([
            'user_id' => $request->user()->id,
            'quiz_id' => $quiz->id,
            'score' => $achieved_score,
            'good_answers_count' => $good_answers_count,
            'created_at' => now(),
        ]);

        Solution::insert(array_map(function($solve) use ($result) {
            return [
                'result_id' => $result->id,
                'question_id' => $solve['question_id'],
                'answer_id' => $solve['user_answer_id'],
            ];
        }, $request->solve));
        
        return redirect()
            ->route('result_solution', ['id' => $result->id])
            ->with('message', __('app.quiz.completed_successfully'));
    }

}
