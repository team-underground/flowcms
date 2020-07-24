<?php

namespace Flowcms\Flowcms\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use Flowcms\Flowcms\Models\Article;
use Flowcms\Flowcms\Models\Category;
use Illuminate\Foundation\Validation\ValidatesRequests;

class CategoryController extends Controller
{
    use ValidatesRequests;

    public function index()
    {
        $categories = Category::withCount('articles')->get();

        return view('flowcms::categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'name' => [
                'required',
                Rule::unique('categories'),
            ]
        ]);

        Category::create([
            'name' => $validated['name'],
            'uuid' => Str::uuid(),
            'slug' => Str::slug($validated['name'])
        ]);

        session()->flash('success', 'Category created');

        return redirect()->back();
    }

    public function edit(Category $category)
    {
        return view('flowcms::categories.edit', compact('category'));
    }

    public function update(Category $category, Request $request)
    {
        $validated = $this->validate($request, [
            'name' => [
                'required',
                Rule::unique('categories')->ignore($category->id),
            ]
        ]);

        $category->fill($validated['name']);
        $category->save();

        session()->flash('success', 'Category updated');

        return redirect()->back();
    }

    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('success', 'Category deleted');

        return redirect()->back();
    }
}
