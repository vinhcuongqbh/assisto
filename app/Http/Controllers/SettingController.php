<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Setting;

class SettingController extends Controller
{    
    public function sloganIndex()
    {
        $setting = Setting::first();        
        return view('admin.setting.slogan', ['setting' => $setting]);
    }


    public function sloganStore(Request $request)
    {
        $setting = Setting::first();
        if (!isset($setting)) $setting = new Setting;
        $setting->slogan = $request->slogan;
        $setting->save();

        return view('admin.setting.slogan', ['setting' => $setting]);
    }
}
