<?php

namespace Flowcms\Flowcms\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Flowcms\Flowcms\Models\Page;
use Flowcms\Flowcms\Models\Block;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;

class PageController extends Controller
{
    use ValidatesRequests;

    public function index()
    {
        $pages = Page::paginate();

        return view('flowcms::pages.index', compact('pages'));
    }

    public function edit(Page $page)
    {
        $dir_path = public_path() . '/icons';
        $dir = new \DirectoryIterator($dir_path);
        $icons = [];

        foreach ($dir as $fileinfo) {
            if (!$fileinfo->isDot()) {
                $fileName = explode('.', $fileinfo->getFilename())[0];
                $fileNameUppercaseWords = ucwords(implode(' ', explode('-', $fileName)));

                $icons[] = [
                    'filenameWithoutExtension' => $fileNameUppercaseWords,
                    'filename' => $fileinfo->getFilename(),
                    'extension' => $fileinfo->getExtension(),
                    'fullpath' => url('icons') . '/' . $fileinfo->getFilename(),
                    'path' => '/icons/' . $fileinfo->getFilename()
                ];
            }
        }

        $blocks = Block::where('page_id', $page->id)->get();
        $blockButtons = collect(config('cms.blocks'))->keys()->all();
        $otherPages = Page::with('blocks:id,page_id,type')->get(['slug', 'id', 'title']);

        // dd($otherPages[0]->blocks->unique('type'));
        return view('flowcms::pages.edit', compact('page', 'blocks', 'icons', 'blockButtons', 'otherPages'));
    }

    public function show($page)
    {
        $page = Page::with('blocks')->where('slug', $page)->firstOrFail();

        // $page->load('blocks');

        if ($page->template == 'landing') {

            // check for the order of pages
            if ($page->layout != '' || $page->layout != null) {
                $layouts = collect(explode(',', $page->layout));

                $services = $layouts->map(function ($item) {
                    return explode('-', $item)[0];
                });

                $pages = $layouts->map(function ($item) {
                    return explode('-', $item)[1];
                })->unique();

                $blocks = Block::with('page')->whereIn('type', $services)
                    ->whereIn('page_id', $pages)
                    ->get()
                    ->groupBy('type');
            }


            // get all pages name with blocks page id
            // $blockPages = Page::whereIn('id', $pages)->get();
        }

        $template = $page->template ?? 'page';

        return view('flowcms::layouts.' . $template, [
            'page' => $page,
            'blocks' => $blocks ?? [],
            'services' => $services ?? [],
            // 'blockPages' => $blockPages ?? [],
            'layouts' => $layouts ?? []
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'title' => [
                'required',
                Rule::unique('pages')
            ]
        ]);

        Page::create([
            'uuid' => Str::uuid(),
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title'])
        ]);

        session()->flash('success', 'Page created');

        return redirect()->back();
    }

    public function update(Page $page, Request $request)
    {
        // $validated = $this->validate($request, [
        //     'title' => ['required'],
        //     'body' => ['required']
        // ]);

        if ($request->has('active')) {
            $request['active'] = $request->boolean('active');
        }

        if ($request->has('show_on_menu')) {
            $request['show_on_menu'] = $request->boolean('show_on_menu');
        }

        $page->fill($request->all());
        $page->save();

        session()->flash('success', 'Page updated');

        return redirect()->back();
    }

    public function destroy(Page $page)
    {
        $page->delete();
        session()->flash('success', 'Page deleted');

        return redirect()->back();
    }
}
