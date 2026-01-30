<?php

namespace App\Http\Controllers;

use App\Enums\userRole;
use App\Models\Category;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class authController extends Controller
{
    public function register(Request $request)
    {
        $user_data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed',
        ]);

        $user_data['role'] = userRole::User->value;

        $user = User::create($user_data); 

        Auth::login($user);   

        return redirect()->route('home');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function home()
    {
        return inertia('home', [
            'categories_count' => Category::count(),
            'quizzes_count' => Quiz::count(),
            'questions_count' => Question::count(),
            'users_count' => User::count(),
        ]);
    }

    public function dashboard()
    {
        return inertia('dashboard');
    }
}
