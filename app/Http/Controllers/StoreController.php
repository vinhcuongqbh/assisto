<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Models\Store;
use App\Models\Center;
use App\Models\User;
use App\Models\StoreMedia;
use Illuminate\Support\Facades\DB;





class StoreController extends Controller
{
    public function index()
    {
        $store = Store::leftjoin('asahi_center', 'asahi_center.centerId', 'asahi_store.centerId')
            ->select('asahi_store.*', 'asahi_center.centerName')
            ->orderby('storeId', 'desc')
            ->get();

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
            'storeName' => 'required|unique:App\Models\Store,storeName',
            'centerId' => 'required',
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
        $store->storeAddr = $request->address;
        $store->storeWorkTime = $request->workTime;
        $store->storeTel = $request->tel;
        $store->storePassword = $request->password;
        $store->storeParkPosition = $request->parkPos;
        $store->asahiDeliveryMethod = $request->delivery;
        $store->asahiSupplement1 = $request->add1;
        $store->asahiSupplement2 = $request->add2;
        $store->comment = $request->comment;
        $store->isDeleted = 0;
        if (isset($path)) $store->storePdfLink = $path;
        $store->insertDate = Carbon::now();
        $store->save();

        // //Lưu file pdf của Store
        // if ($request->hasFile('inputFile')) {            
        //     $allowedfileExtension = ['pdf'];
        //     $files = $request->file('inputFile');
        //     foreach ($files as $file) {
        //         //$filename = $file->getClientOriginalName();
        //         $extension = $file->getClientOriginalExtension();
        //         $check = in_array($extension, $allowedfileExtension);
        //         if ($check) {
        //             $path = $file->store('public/File');
        //             $path = substr($path, strlen('public/'));
        //             $storeMedia = new storeMedia();
        //             $storeMedia->storeId = $store->storeId;
        //             $storeMedia->storePdfLink = $path;
        //             $storeMedia->save();
        //         }  
        //     }
        // }

        if (Auth::user()->roleId != 3) return redirect()->route('store.show', ['id' => $store->storeId]);
        else return redirect()->route('staff.store.show', ['id' => $store->storeId]);
    }


    public function show($id)
    {
        $store = Store::where('storeId', $id)
            ->leftjoin('asahi_center', 'asahi_center.centerId', 'asahi_store.centerId')
            ->select('asahi_store.*', 'asahi_center.centerName')
            ->first();

        $storeMedia = StoreMedia::where('storeId', $id)->get();

        if (Auth::user()->roleId != 3) return view('admin.store.show', ['store' => $store, 'storeMedias' => $storeMedia]);
        else return view('staff.store.show', ['store' => $store, 'storeMedias' => $storeMedia]);
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
        $store->storeAddr = $request->address;
        $store->storeWorkTime = $request->workTime;
        $store->storeTel = $request->tel;
        $store->storePassword = $request->password;
        $store->storeParkPosition = $request->parkPos;
        $store->asahiDeliveryMethod = $request->delivery;
        $store->asahiSupplement1 = $request->add1;
        $store->asahiSupplement2 = $request->add2;
        $store->comment = $request->comment;
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
        $store->isDeleted = 1;
        $store->save();

        if (Auth::user()->roleId != 3) return redirect()->route('store');
        else return redirect()->route('staff.store');
    }


    public function restore($id)
    {
        //Tìm Cửa hàng 
        $store = Store::where('storeId', $id)->first();
        $store->isDeleted = 0;
        $store->save();

        if (Auth::user()->roleId != 3) return redirect()->route('store');
        else return redirect()->route('staff.store');
    }


    public function search(Request $request)
    {
        $store = Store::join('asahi_center', 'asahi_center.centerId', 'asahi_store.centerId')
            ->select('asahi_store.*', 'asahi_center.centerName')
            ->orderby('asahi_store.storeId', 'desc');

        if (isset($request->storeID)) $store->where('storeId', $request->storeID);
        if (isset($request->storeName)) $store->where('storeName', 'LIKE', '%' . $request->storeName . '%');
        if (isset($request->address)) $store->where('storeAddr', 'LIKE', '%' . $request->address . '%');
        if (isset($request->telephone)) $store->where('storeTel', 'LIKE', '%' . $request->telephone . '%');
        if (isset($request->centerName)) $store->where('centerName', 'LIKE', '%' . $request->centerName . '%');

        $store = $store->get();

        if (Auth::user()->roleId != 3) return view('admin.store.result', ['stores' => $store]);
        else return view('staff.store.result', ['stores' => $store]);
    }
}
