<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\Center;
use Carbon\Carbon;

class CenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $center = Center::all();
        return view('admin.center.index', ['centers' => $center]);
    }

    
    public function create()
    {        
        return view('admin.center.create');
    }

    
    public function store(Request $request)
    {
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'centerId' => 'required|unique:App\Models\Center,centerId',
            'centerName' => 'required',          
        ]);

        //Tạo Trung tâm mới
        $center = new center;
        $center->centerId = $request->centerId;
        $center->centerName = $request->centerName;
        $center->centerTel = $request->centerTel;
        $center->centerAddr = $request->centerAddr;
        $center->insertDate = Carbon::now();
        $center->save();

        return redirect()->route('center.show', ['id' => $center->centerId]);
    }

    
    public function show($id)
    {
        $center = Center::where('centerId', $id)->first();
        return view('admin.center.show',['center' => $center]);
    }

    
    public function edit($id)
    {
        $center = Center::where('centerId', $id)->first();

        return view('admin.center.edit', ['center' => $center]);
    }

    
    public function update(Request $request, $id)
    {
        //Tìm thông tin Trung tâm
        $center = Center::where('centerId', $id)->first();

        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'centerId' => [
                'required',
                Rule::unique('asahi_center', 'centerId')->ignore($center->id)
            ],
            'centerName' => 'required',  
        ]);

        
        $center->centerId = $request->centerId;
        $center->centerName = $request->centerName;
        $center->centerTel = $request->centerTel;
        $center->centerAddr = $request->centerAddr;
        $center->lastUpdateDate = Carbon::now();
        $center->save();

        return redirect()->route('center.show', ['id' => $center->centerId]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
