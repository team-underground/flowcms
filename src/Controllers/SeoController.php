<?php

namespace Flowcms\Flowcms\Controllers;

use Flowcms\Flowcms\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SeoController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return view('flowcms::seo.index', compact('pages'));
    }
}
