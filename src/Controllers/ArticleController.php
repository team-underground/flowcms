<?php

namespace Flowcms\Flowcms\Controllers;

use Carbon\Carbon;
use Flowcms\Flowcms\Models\Article;
use Flowcms\Flowcms\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('category')->orderByDesc('publish_date')->paginate(10);

        return view('flowcms::articles.index', compact('articles'));
    }

    public function articles()
    {
        $article = Article::with('category')->orderByDesc('publish_date');

        if ($search = request('s')) {
            $article->where('title', 'like', '%' . $search . '%');
        }

        $articles = $article->paginate(10);

        return view('flowcms::articles._articles', compact('articles'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('flowcms::articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $categoryIDs = Category::pluck('id')->all();

        $request->validate([
            'category' => ['required', Rule::in($categoryIDs)],
            'title' => ['required'],
            'body' => ['required'],
            'image' => ['nullable', 'url'],
            'status' => ['nullable'],
            'publish_date' => ['required']
        ]);

        $article = new Article;
        $article->user_id = auth()->id();
        $article->category_id = $request->category;
        $article->title = $request->title;
        $article->slug = Str::slug($request->title) . '-' . Str::random(8);
        $article->body = $request->body;
        // $article->body_html = GitDown::parseAndCache($request->body);
        $article->image = $request->image ?? '';

        // @Todo
        // if ($request->has('image')) {
        //     $imagePath = Storage::disk('public')->put('uploads', $request->image);
        //     $article->image = Storage::url($imagePath);
        // }

        $article->status = $request->boolean('status');
        $article->publish_date = Carbon::parse($request->publish_date)->format('Y-m-d');
        $article->save();

        session()->flash('success', 'Article created');

        return redirect()->route('flowcms::articles.index');
    }

    public function edit(Article $article)
    {
        $categories = Category::orderBy('name')->get();
        return view('flowcms::articles.edit', compact('article', 'categories'));
    }

    public function update(Article $article, Request $request)
    {
        // dd($request->input('body'));

        $categoryIDs = Category::pluck('id')->all();

        $validated = $request->validate([
            'category' => ['required', Rule::in($categoryIDs)],
            'title' => ['required'],
            'body' => ['required'],
            'image' => ['nullable', 'url'],
            'status' => ['nullable'],
            'publish_date' => ['nullable']
        ]);

        $validated['category_id'] = $validated['category'];

        if ($request->has('status')) {
            $validated['status'] = $request->boolean('status');
        }

        $validated['publish_date'] = Carbon::parse($validated['publish_date'])->format('Y-m-d');

        $article->fill($validated);
        $article->save();

        session()->flash('success', 'Article updated');

        return redirect()->back();
    }

    public function destroy(Article $article)
    {
        $article->delete();

        if (request()->wantsJson()) {
            return response()->json('Article deleted', 200);
        } else {
            session()->flash('success', 'Article deleted');
            return redirect()->back();
        }
    }
}
