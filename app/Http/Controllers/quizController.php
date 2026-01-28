<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Quiz;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class quizController extends Controller
{
    public function index()
    {
        return inertia('quiz/index');
    }

    public function mylist(Request $request)
    {
        $quizes = Quiz::with(['category', 'user'])->withCount('questions')->where('user_id', $request->user()->id)->get();

        return inertia('quiz/mylist', ['quizes' => $quizes]);
    }

    public function show($id)
    {
        return inertia('quiz/show', ['id' => $id]);
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

        $fields = Validator::make($request->all(), [
            'name' => ['required', 'max:255'],
            'category' => ['required', 'exists:categories,id'],
            'questions.*.content' => ['required', 'string'],
            'questions.*.time_to_answer' => ['required', 'integer', 'min:1'],
            'questions.*.score' => ['required', 'integer', 'min:1'],
            'questions.*.answers.*.content' => ['required', 'string'],
            'questions.*.good_answer' => ['required', 'integer'],
        ], [
            'questions.*.content.required' => __('validation.questions.content.required'),
            'questions.*.time_to_answer.required' => __('validation.questions.time_to_answer.required'),
            'questions.*.score.required' => __('validation.questions.score.required'),
            'questions.*.answers.*.content.required' => __('validation.questions.answers.content.required'),
        ])->validate();

        $fields['user_id'] = $request->user()->id;

        Quiz::procesForm($fields);

        return redirect()
            ->route('quiz_mylist')
            ->with('message', __('app.quiz.created_successfully'));
    }

    public function edit($id)
    {
        return inertia('quiz/edit', ['id' => $id]);
    }

    public function update(Request $request, $id)
    {
        // Handle updating quiz data
    }

    public function destroy($id)
    {
        // Handle deleting quiz data
    }
}
