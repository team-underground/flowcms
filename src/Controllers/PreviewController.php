<?php

namespace Flowcms\Flowcms\Controllers;

use Flowcms\Flowcms\Models\Block;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PreviewController extends Controller
{
    public function show()
    {
        $services = Block::latest()->get();
        return view('flowcms::preview.show', compact('services'));
    }
}
