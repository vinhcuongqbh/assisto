<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guide;
use Illuminate\Support\Facades\Auth;

class GuideController extends Controller
{
    public function index()
    {
        $guide = Guide::all()->first();        

        if (Auth::user()->roleId != 3) return view('admin.guide.index', ['guide' => $guide]);
        else return view('staff.guide.index', ['guide' => $guide]);
    }

    public function store(Request $request)
    {
        //Xử lý đường dẫn File
        if (!empty($request->file('guideFile'))) {
            $path = $request->file('guideFile')->store('public/File');
            $path = substr($path, strlen('public/'));

            $guide = Guide::all()->first();
            if (!isset($guide)) $guide = new Guide;           
            $guide->guide_file_url = $path;
            $guide->save();
        }

        return view('admin.guide.index', ['guide' => $guide]);
    }
}
