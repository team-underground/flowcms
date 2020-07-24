<?php

namespace Flowcms\Flowcms\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ProfileController extends Controller
{
    use ValidatesRequests;

    public function index()
    {
        return view('flowcms::profile.index');
    }

    public function update(Request $request)
    {
        $validated = $this->validate($request, [
            'name' => ['required'],
            'email' => ['required', 'email', Rule::unique('users')->ignore(auth()->user()->id)],
            'password' => ['sometimes', 'confirmed']
        ]);

        if ($request->password != null) {
            auth()->user()->update([
                'password' => bcrypt($validated['password'])
            ]);
        }

        auth()->user()->update([
            'name' => $validated['name'],
            'email' => $validated['email']
        ]);

        session()->flash('success', 'Profile updated.');

        return redirect()->back();
    }
}
