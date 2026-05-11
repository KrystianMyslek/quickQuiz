<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Quiz extends Model
{
    use SoftDeletes;

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

    public function result(): HasOne
    {
        return $this->hasOne(Result::class, 'quiz_id', 'id');
    }

    public function rating(): HasMany
	{
		return $this->hasMany(Rating::class, 'quiz_id', 'id');
	}

    public function questionsScore() : int
    {
        return $this->questions()->sum('score');
    }

	public static function index(Request $request) {
        $quizes = Quiz::when($request->search, function($query) use ($request) {
	        $query
			->when($request->user(), function ($query, $user) {
				return $query->where('user_id', '!=', $user->id);
			})
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
        ->with(['category', 'user', 'result'])
		->withAvg('rating', 'score')
		->when($request->user(), function ($query, $user) {
			return $query->where('user_id', '!=', $user->id);
		})
		->when($request->selected_categories, function($query) use ($request) {
			$query->whereIn('category_id', explode(',', $request->selected_categories));
		})
		->when($request->user(), function ($query, $user) {
			return $query->whereDoesntHave('result', function ($query) use ($user) {
    			$query->where('user_id', '=', $user->id);
			});
		})
        ->withCount('questions')
        ->paginate(10)
        ->withQueryString();

		return $quizes;
	}
}
