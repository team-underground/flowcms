<?php

namespace Flowcms\Flowcms\Controllers\Front;

use Carbon\Carbon;
use Flowcms\Flowcms\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;

class ArticleController extends Controller
{
    public function index()
    {
        $page = request('page') ?? 1;

        $articles = Cache::get('articles_' . $page, function () {
            return Article::with(['category', 'user'])
                ->orderBy('publish_date', 'desc')
                ->isPublished()
                ->paginate(10);
        });

        return view('flowcms::front.articles.index', compact('articles'));
    }

    public function show($article)
    {
        $article = Cache::rememberForever('articles-' . $article, function () use ($article) {
            $articleFound = Article::with(['category', 'user'])
                ->where('id', $article)
                ->orWhere('slug', $article)
                ->isPublished()
                ->first();

            views($articleFound)->record();
            return $articleFound;
        });

        return view('flowcms::front.articles.show', compact('article'));
    }

    public function articles()
    {
        $page = request('page') ?? 1;

        $articles = Cache::remember('articles_' . $page, Carbon::parse('5 seconds'), function () {
            return Article::with(['category', 'user'])
                ->orderBy('publish_date', 'desc')
                ->isPublished()
                ->paginate(10);
        });

        return view('flowcms::front.articles._articles', compact('articles'));
    }
}
