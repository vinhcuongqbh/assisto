<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Models\Store;
use App\Models\Center;
use App\Models\User;



class StoreController extends Controller
{
    public function index()
    {
        $store = Store::all();
        return view('admin.store.index', ['stores' => $store]);
    }


    public function create()
    {
        $center = Center::all();
        if (Auth::user()->roleId != 3) return view('admin.store.create', ['center' => $center]);
        else return view('staff.store.create', ['center' => $center]);
    }


    public function store(Request $request)
    {
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'storeId' => 'required|unique:App\Models\Store,storeId',
            'storeName' => 'required',
            'centerId' => 'required',
            'inputFile' => ['required','mimes:pdf']
        ]);

        //Xử lý đường dẫn File
        if (!empty($request->file('inputFile'))) {
            $path = $request->file('inputFile')->store('public/File');
            $path = substr($path, strlen('public/'));
        }

        //Tạo Cửa hàng mới
        $store = new Store;
        $store->storeId = $request->storeId;
        $store->storeName = $request->storeName;
        $store->centerId = $request->centerId;
        if (isset($request->address)) $store->storeAddr = $request->address;
        if (isset($request->workTime)) $store->storeWorkTime = $request->workTime;
        if (isset($request->tel)) $store->storeTel = $request->tel;
        if (isset($request->password)) $store->storePassword = $request->password;
        if (isset($request->parkPos)) $store->storeParkPosition = $request->parkPos;
        if (isset($request->delivery)) $store->asahiDeliveryMethod = $request->delivery;
        if (isset($request->add1)) $store->asahiSupplement1 = $request->add1;
        if (isset($request->add2)) $store->asahiSupplement2 = $request->add2;
        if (isset($path)) $store->storePdfLink = $path;
        $store->insertDate = Carbon::now();
        $store->save();

        if (Auth::user()->roleId != 3) return redirect()->route('store.show', ['id' => $store->storeId]);
        else return redirect()->route('staff.store.show', ['id' => $store->storeId]);
    }


    public function show($id)
    {
        $store = Store::where('storeId', $id)
            ->leftjoin('asahi_center', 'asahi_center.centerId', 'asahi_store.centerId')
            ->select('asahi_store.*', 'asahi_center.centerName')
            ->first();

        if (Auth::user()->roleId != 3) return view('admin.store.show', ['store' => $store]);
        else return view('staff.store.show', ['store' => $store]);
    }


    public function edit($id)
    {
        $store = Store::where('storeId', $id)->first();
        $center = Center::all();

        if (Auth::user()->roleId != 3)  return view('admin.store.edit', ['store' => $store, 'center' => $center]);
        else return view('staff.store.edit', ['store' => $store, 'center' => $center]);
    }


    public function update(Request $request, $id)
    {
        //Tìm Cửa hàng 
        $store = Store::where('storeId', $id)->first();

        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'storeId' => [
                'required',
                Rule::unique('asahi_store', 'storeId')->ignore($store->id)
            ],
            'storeName' => 'required',
            'centerId' => 'required',
            'inputFile' => ['required','mimes:pdf']
        ]);

        //Xử lý đường dẫn File
        if (!empty($request->file('inputFile'))) {
            $path = $request->file('inputFile')->store('public/File');
            $path = substr($path, strlen('public/'));
        }

        //Update Thông tin cửa hàng
        $store->storeId = $request->storeId;
        $store->storeName = $request->storeName;
        $store->centerId = $request->centerId;
        if (isset($request->address)) $store->storeAddr = $request->address;
        if (isset($request->workTime)) $store->storeWorkTime = $request->workTime;
        if (isset($request->tel)) $store->storeTel = $request->tel;
        if (isset($request->password)) $store->storePassword = $request->password;
        if (isset($request->parkPos)) $store->storeParkPosition = $request->parkPos;
        if (isset($request->delivery)) $store->asahiDeliveryMethod = $request->delivery;
        if (isset($request->add1)) $store->asahiSupplement1 = $request->add1;
        if (isset($request->add2)) $store->asahiSupplement2 = $request->add2;
        if (isset($path)) $store->storePdfLink = $path;
        $store->lastUpdateDate = Carbon::now();
        $store->lastUpdateStaffId = Auth::id();
        $store->save();

        if (Auth::user()->roleId != 3) return redirect()->route('store.show', ['id' => $store->storeId]);
        else return redirect()->route('staff.store.show', ['id' => $store->storeId]);
    }


    public function destroy($id)
    {
        //Tìm Cửa hàng 
        $store = Store::where('storeId', $id)->first();
        $store->delete();

        if (Auth::user()->roleId != 3) return redirect()->route('store');
        else return redirect()->route('staff.store.search');
    }


    public function search(Request $request)
    {
        $store = Store::query();

        if (isset($request->storeID)) $store->where('storeId', $request->storeID);
        if (isset($request->storeName)) $store->where('storeName', 'LIKE', '%'.$request->storeName.'%');
        if (isset($request->address)) $store->where('storeAddr', 'LIKE', '%'.$request->address.'%');
        if (isset($request->telephone)) $store->where('storeTel', $request->telephone);        
        if (isset($request->centerID)) $store->where('centerId', $request->centerID);
        
        $store = $store->get(); 
        
        if (Auth::user()->roleId != 3) return view('admin.store.result', ['stores' => $store]);
        else return view('staff.store.result', ['stores' => $store]);
    }
}
