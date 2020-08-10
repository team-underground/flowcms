<?php

namespace Flowcms\Flowcms\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Flowcms\Flowcms\Models\Contact;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ContactController extends Controller
{
    use ValidatesRequests;

    public function index(Request $request)
    {
        $contact = Contact::query();

        if ($request->ajax()) {
            if ($search = request('s')) {
                $contact->where('name', 'like', '%' . $search . '%');
                $contact->orWhere('email', 'like', '%' . $search . '%');
                $contact->orWhere('body', 'like', '%' . $search . '%');
            }

            $contacts = $contact->latest()->paginate(10);

            return view('flowcms::contacts._contacts', compact('contacts'));
        }

        $contacts = $contact->latest()->paginate(10);

        return view('flowcms::contacts.index', compact('contacts'));
    }

    // public function contacts()
    // {
       
    // }

    public function store(Request $request)
    {
        $cmsblocks = collect(config('cms.blocks.contact_us'))->all();
        $formFields = collect($request->except('_token'))->keys();

        foreach ($cmsblocks as $cmsblock) {
            if ($formFields->contains($cmsblock['field'])) {
                $rules[$cmsblock['field']] = $cmsblock['rules'];
            }
        }

        $validatedData = $this->validate($request, $rules);
        // $validatedData['body'] = preg_replace( "/\r|\n/", "", $validatedData['body']);

        Contact::create($validatedData + ['uuid' => Str::uuid()]);

        session()->flash('success', 'Thank you, we have recieved your message.');

        return redirect()->back();
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        if (request()->wantsJson()) {
            return response()->json('Contact deleted', 200);
        } else {
            session()->flash('success', 'Contact deleted');
            return redirect()->back();
        }
    }
}
