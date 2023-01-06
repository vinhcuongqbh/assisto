<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Route;
use App\Models\Store;
use App\Models\User;

class StaffController extends Controller
{
    public function index()
    {
        return view('staff.shipment.search');
    }


    public function search(Request $request)
    {
        $route = Route::where('routeDate', $request->date)
            ->where('staffId', Auth::user()->userId)
            ->leftjoin('asahi_store', 'asahi_store.storeId', 'asahi_route.storeId')
            ->select('asahi_route.*', 'asahi_store.*')
            ->get();

        return view('staff.shipment.result', ['routes' => $route, 'date' => $request->date]);
    }
}
