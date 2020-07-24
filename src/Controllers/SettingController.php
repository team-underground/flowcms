<?php

namespace Flowcms\Flowcms\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Flowcms\Flowcms\Models\Setting;
use Illuminate\Foundation\Validation\ValidatesRequests;

class SettingController extends Controller
{
    use ValidatesRequests;

    public function index()
    {
        return view('flowcms::settings.index');
    }

    public function store(Request $request)
    {
        $rules = Setting::getValidationRules();
        unset($rules['site_admin']);
        $data = $this->validate($request, $rules);

        $validSettings = array_keys($rules);

        foreach ($data as $key => $val) {
            if (in_array($key, $validSettings)) {
                Setting::add($key, $val, Setting::getDataType($key));
            }
        }

        session()->flash('success', 'Settings has been saved.');

        return redirect()->back();
    }
}
