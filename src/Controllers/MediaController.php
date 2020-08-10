<?php

namespace Flowcms\Flowcms\Controllers;

use Flowcms\Flowcms\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $media = Media::query();

        if ($request->ajax()) {
            if ($search = request('s')) {
                $media->where('name', 'like', '%' . $search . '%');
            }

            $medias = $media->latest()->paginate(12);
            return view('flowcms::media._media', compact('medias'))->render();
        }

        $medias = $media->latest()->paginate(12);
        return view('flowcms::media.index', compact('medias'));
    }

    // public function media(Request $request)
    // {
    //     $media = Media::query();

    //     if ($search = request('s')) {
    //         $media->where('name', 'like', '%' . $search . '%');
    //     }

    //     $medias = $media->latest()->paginate(12);

    //     return view('flowcms::media._media', compact('medias'));
    // }

    public function store(Request $request)
    {
        if ($request->has('file')) {

            $request->validate([
                'file' => ['required', 'image']
            ]);

            $path = $request->file('file')->store('uploads');

            // Optimize the image
            // the image will be replaced with an optimized version which should be smaller
            // ImageOptimizer::optimize(Storage::url($path));

            // Save in the database
            Media::create([
                'user_id' => auth()->id(),
                'name' => $request->file('file')->getClientOriginalName(),
                'path' => $path,
                'type' => $request->file('file')->getClientOriginalExtension(),
                'size' => $request->file('file')->getSize()
            ]);

            return response()->json($path, 200);
        }

        return response()->json('No file input', 200);
    }

    public function destroy(Request $request)
    {
        $imagePath = $request->get('path');

        $found = Media::where('path', $imagePath)->first();

        if (!$found) {
            return response()->json('file not found', 500);
        }

        $exists = Storage::disk('public')->exists($found->path);
        if ($exists) {
            Storage::delete($found->path);
            // Storage::delete('.cache/' . $found->path);
        }

        $found->delete();
        return response()->json('Deleted', 200);
    }
}
