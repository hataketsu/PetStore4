<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{

    //show all settings
    public function index()
    {
        return view('setting.index', ['title' => 'Settings']);

    }

    //save settings
    public function save(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'phone' => 'required|string',
        ]);
        \Setting::set('email',$request->get('email'));
        \Setting::set('phone',$request->get('phone'));
        $more_links = [];
        $labels = $request->get('more_labels');
        $links = $request->get('more_links');
        foreach (array_combine($labels, $links) as $label => $link) {
            if (empty(trim($label)) || empty(trim($link)))
                continue;
            $more_links = array_add($more_links, $label, $link);
        }
        \Setting::set('more_links', $more_links);
        return redirect('/manage/settings');
    }
}
