<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings=Setting::where('group','social')->orderBy('id')->get();
        return view('dashboard.views-dash.setting.index',compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token' , '_method']);
        foreach ($data as $k => $v) {
            $this->update_setting([
                'key' => $k,
                'value' => $v
            ], $k);
        }

        return redirect()->back()->with('success', 'Added successfully');
    }

    public function update_setting($data,$key){
        return Setting::where('key',$key)->update($data);
    }
}
