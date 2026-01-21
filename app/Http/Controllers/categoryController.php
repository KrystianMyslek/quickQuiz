<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class categoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return inertia('category/index', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        Gate::authorize('create', Category::class);

        return inertia('category/create');
    }

    public function store(Request $request)
    {
        Gate::authorize('create', Category::class);

        $fields = $request->validate([
            'image' => ['file', 'nullable', 'max:3000'],
            'name' => ['required', 'max:255'],
        ]);

        if ($request->hasFile('image')) {
            $fields['image'] = Storage::disk('public')->put('categories', $request->image);
        }

        Category::create($fields);

        return redirect()
            ->route('category_index')
            ->with('message', __('category.created_successfully'));
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        Gate::authorize('update', Category::class);

        return inertia('category/edit', ['category' => $category]);
    }

    public function update(Request $request, $id)
    {
        Gate::authorize('update', Category::class);

        $category = Category::findOrFail($id);
        $fields = $request->validate([
            'image' => ['file', 'nullable', 'max:3000'],
            'name' => ['required', 'max:255'],
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $fields['image'] = Storage::disk('public')->put('categories', $request->image);
        } else {
            unset($fields['image']);
        }

        $category->update($fields);

        return redirect()
            ->route('category_index')
            ->with('message', __('category.updated_successfully'));
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        Gate::authorize('delete', Category::class);

        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()
            ->route('category_index')
            ->with('message', __('category.deleted_successfully'));
    }
}
