<?php

namespace Flowcms\Flowcms\Controllers;

use Flowcms\Flowcms\Models\Page;
use Flowcms\Flowcms\Models\Article;
use Flowcms\Flowcms\Models\Category;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $categoriesCount = Category::count();
        $articlesCount = Article::count();
        $pagesCount = Page::count();
        $viewCount = views(Article::class)->count();

        return view('flowcms::dashboard', compact('categoriesCount', 'articlesCount', 'pagesCount', 'viewCount'));
    }
}
