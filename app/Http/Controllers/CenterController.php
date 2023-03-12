<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $center = Center::orderBy('centerId', 'desc')->get();
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
        $center->isDeleted = 0;
        $center->insertDate = Carbon::now();
        $center->save();

        return redirect()->route('center.show', ['id' => $center->centerId]);
    }


    public function show($id)
    {
        $center = Center::where('centerId', $id)->first();
        return view('admin.center.show', ['center' => $center]);
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

    public function destroy($id)
    {
        //Tìm Cửa hàng 
        $center = Center::where('centerId', $id)->first();
        $center->isDeleted = 1;
        $center->save();

        return redirect()->route('center');
    }


    public function restore($id)
    {
        //Tìm Cửa hàng 
        $center = Center::where('centerId', $id)->first();
        $center->isDeleted = 0;
        $center->save();

        return redirect()->route('center');
    }


    public function search(Request $request)
    {
        $center = Center::orderBy('centerId','desc');

        if (isset($request->centerID)) $center->where('centerId', $request->centerID);
        if (isset($request->centerName)) $center->where('centerName', 'LIKE', '%' . $request->centerName . '%');
        if (isset($request->address)) $center->where('centerAddr', 'LIKE', '%' . $request->address . '%');
        if (isset($request->telephone)) $center->where('centerTel', $request->telephone);

        $center = $center->get();

        return view('admin.center.result', ['centers' => $center]);
    }
}
