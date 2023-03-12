<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\Route;
use App\Models\User;
use App\Models\Store;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route = Route::leftjoin('moz_users', 'moz_users.userId', 'asahi_route.staffId')
        ->leftjoin('asahi_store', 'asahi_store.storeId', 'asahi_route.storeId')
        ->select('asahi_route.*', 'moz_users.name', 'asahi_store.storeName')
        ->get();

        return view('admin.route.index', ['routes' => $route]);
    }


    public function create()
    {
        $route = Route::all();
        $staff = User::where('isDeleted', '<>', 1)
            ->where('roleId', 3)
            ->get();
        $store = Store::all();

        return view('admin.route.create', ['route' => $route, 'staff' => $staff, 'store' => $store]);
    }


    public function store(Request $request)
    {
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'routeId' => 'required|unique:App\Models\Route,routeId',
            'routeDate' => 'required',
        ]);

        //Tạo Trung tâm mới
        $route = new route;
        $route->routeId = $request->routeId;
        $route->routeDate = $request->routeDate;
        $route->staffId = $request->staffId;
        $route->course = $request->course;
        $route->storeId = $request->storeId;
        $route->save();

        return redirect()->route('route.show', ['id' => $route->routeId]);
    }


    public function show($id)
    {
        $route = Route::where('routeId', $id)
            ->leftjoin('asahi_store', 'asahi_store.storeId', 'asahi_route.storeId')
            ->leftjoin('moz_users', 'moz_users.userId', "asahi_route.staffId")
            ->select('asahi_route.*', 'asahi_store.storeName', 'moz_users.name')
            ->first();

        return view('admin.route.show', ['route' => $route]);
    }


    public function edit($id)
    {
        $route = Route::where('routeId', $id)->first();
        $staff = User::where('isDeleted', '<>', 1)
            ->where('roleId', 3)
            ->get();
        $store = Store::all();

        return view('admin.route.edit', [
            'route' => $route,
            'staff' => $staff,
            'store' => $store,
        ]);
    }

    
    public function update(Request $request, $id)
    {
        //Tìm thông tin Trung tâm
        $route = Route::where('routeId', $id)->first();

        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'routeId' => [
                'required',
                Rule::unique('asahi_route', 'routeId')->ignore($route->id)
            ],
            'routeDate' => 'required',
        ]);

        
        $route->routeId = $request->routeId;
        $route->routeDate = $request->routeDate;
        $route->staffId = $request->staffId;
        $route->course = $request->course;
        $route->storeId = $request->storeId;
        $route->save();

        return redirect()->route('route.show', ['id' => $route->routeId]);
    }

    
    public function destroy($id)
    {
        //
    }
    

    public function search()
    {
        return view('staff.route.search');
    }
    
    public function result(Request $request)
    {
        $route = Route::where('routeDate', $request->date)
            ->where('staffId', Auth::user()->userId)
            ->leftjoin('asahi_store', 'asahi_store.storeId', 'asahi_route.storeId')
            ->select('asahi_route.*', 'asahi_store.*')
            ->get();

        return view('staff.route.result', ['routes' => $route, 'date' => $request->date]);
    }
}
