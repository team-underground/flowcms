<?php

namespace Flowcms\Flowcms\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Flowcms\Flowcms\Models\Page;
use Flowcms\Flowcms\Models\Block;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BlockController extends Controller
{
    use ValidatesRequests;

    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'type' => [
                'required',
                Rule::in(collect(config('cms.blocks'))->keys()->all())
            ]
        ]);

        $blocks = collect(config('cms.blocks.' . $validated["type"] . ''))->all();
        foreach ($blocks as $block) {
            $content[$block['field']] = '';
        }

        Block::create([
            'uuid' => Str::uuid(),
            'page_id' => $request->page_id,
            'type' => $request->type,
            'value' => $content
        ]);

        session()->flash('success', 'Block added.');

        return redirect()->back();
    }

    public function update(Block $block, Request $request)
    {
        $cmsblocks = collect(config('cms.blocks.' . $block->type . ''))->all();

        // Every name field must have a unique name for validation
        // orelse it will print the error message in all cards
        // as all cards are in a loop
        foreach ($cmsblocks as $cmsblock) {
            $rules[$cmsblock['field'] . '-' . $block->id] = $cmsblock['rules'];
            $fields[$cmsblock['field'] . '-' . $block->id] = $cmsblock['field'];
        }

        $validated = $this->validate($request, $rules, [], $fields);

        // Removed all the -* from the keys
        $validatedData = collect($validated)->mapWithKeys(function ($item, $key) {
            return [explode('-', $key)[0] => $item];
        });

        $block->fill([
            'value' => $validatedData->all()
        ]);

        $block->save();

        session()->flash('success', 'Block updated');

        return redirect()->back();
    }

    public function destroy(Block $block)
    {
        $pageName = $block->type . '-' . $block->page_id;

        // find if any pageName exists in the landing page layout
        // if exists delete or dont do anything
        // eg. hero_centered-3,services-4,hero_image_left-3,hero_image_right-3
        $page = Page::isLanding()->first();
        $layoutsArrayInLanding = collect(explode(',', $page->layout));
        $layoutsUpdated = $layoutsArrayInLanding->filter(function ($value, $key) use ($pageName) {
            return $value !== $pageName;
        })->implode(',');

        $page->update([
            'layout' => $layoutsUpdated
        ]);

        $block->delete();

        session()->flash('success', 'Block deleted');

        return redirect()->back();
    }
}
