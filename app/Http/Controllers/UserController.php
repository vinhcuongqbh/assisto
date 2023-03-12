<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Center;
use App\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::user()->roleId == 3) {
            return redirect()->route('staff.store');
        } else if (Auth::user()->roleId == 2) {
            //Hiển thị danh sách Tài khoản đang sử dụng
            $user = User::leftjoin('moz_roles', 'moz_roles.roleId', 'moz_users.roleId')
                ->leftjoin('asahi_center', 'asahi_center.centerId', 'moz_users.centerId')
                ->where('moz_users.roleId', '<>', 1)
                ->select('moz_users.*', 'moz_roles.roleName', 'asahi_center.centerName')
                ->orderBy('userId', 'desc')
                ->get();
        } else {
            //Hiển thị danh sách Tài khoản đang sử dụng
            $user = User::leftjoin('moz_roles', 'moz_roles.roleId', 'moz_users.roleId')
                ->leftjoin('asahi_center', 'asahi_center.centerId', 'moz_users.centerId')
                ->select('moz_users.*', 'moz_roles.roleName', 'asahi_center.centerName')
                ->orderBy('userId', 'desc')
                ->get();
        }

        return view('admin.user.index', ['users' => $user]);
    }


    public function create()
    {

        $center = Center::all();
        $userRole = Role::where('roleId', '!=', 1)->get();


        return view('admin.user.create', [
            'userRole' => $userRole,
            'center' => $center,
        ]);
    }


    public function store(Request $request)
    {
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'userId' => 'required|unique:App\Models\User,userId',
            'name' => 'required',
            'centerId' => 'required',
            'roleId' => 'required',
        ]);

        //Tạo Nhân viên mới
        $user = new User;
        $user->userId = $request->userId;
        $user->name = $request->name;
        if (isset($request->password)) {
            $user->password = Hash::make($request->password);
        } else {
            $user->password = Hash::make("");
        }
        $user->centerId = $request->centerId;
        $user->roleId = $request->roleId;
        $user->isDeleted = 0;
        $user->createdBy = Auth::id();
        $user->createdDtm = Carbon::now();
        $user->save();

        return redirect()->route('user.show', ['id' => $user->userId]);
    }


    public function show($id)
    {
        $user = User::where('userId', $id)
            ->join('moz_roles', 'moz_roles.roleId', 'moz_users.roleId')
            ->join('asahi_center', 'asahi_center.centerId', 'moz_users.centerId')
            ->select('moz_users.*', 'moz_roles.roleName', 'asahi_center.centerName')
            ->first();

        return view('admin.user.show', ['user' => $user,]);
    }


    public function edit($id)
    {
        $user = User::where('userId', $id)->first();

        $center = Center::all();
        $userRole = Role::where('roleId', '!=', 1)->get();


        return view('admin.user.edit', [
            'user' => $user,
            'userRole' => $userRole,
            'center' => $center,
        ]);
    }


    public function update(Request $request, $id)
    {
        //Tìm thông tin Nhân viên
        $user = User::where('userId', $id)->first();

        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'userId' => [
                'required',
                Rule::unique('moz_users', 'userId')->ignore($user->id)
            ],
            'name' => 'required',

            'centerId' => 'required',
            'roleId' => 'required',

        ]);

        //Cập nhật thông tin Nhân viên        
        $user->userId = $request->userId;
        $user->name = $request->name;
        $user->centerId = $request->centerId;
        $user->roleId = $request->roleId;
        $user->updatedBy = Auth::id();
        $user->updatedDtm = Carbon::now();
        $user->save();

        return redirect()->route('user.show', ['id' => $user->userId]);
    }

    //Khóa tài khoản Nhân viên
    public function destroy($id)
    {
        $user = User::where('userId', $id)->first();
        $user->isDeleted = 1;
        $user->save();

        return back();
    }


    //Mở lại tài khoản Nhân viên
    public function restore($id)
    {
        $user = User::where('userId', $id)->first();
        $user->isDeleted = 0;
        $user->save();

        return back();
    }


    public function resetpass(Request $request, $id)
    {
        //Tìm thông tin Nhân viên
        $user = User::where('userId', $id)->first();

        //Cập nhật thông tin Nhân viên        
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('user.show', ['id' => $user->userId]);
    }


    public function search(Request $request)
    {

        $user = User::leftjoin('moz_roles', 'moz_roles.roleId', 'moz_users.roleId')
            ->leftjoin('asahi_center', 'asahi_center.centerId', 'moz_users.centerId')
            ->select('moz_users.*', 'moz_roles.roleName', 'asahi_center.centerName')
            ->orderBy('userId', 'desc');

        if (isset($request->userID)) $user->where('userId', $request->userID);
        if (isset($request->userName)) $user->where('name', 'LIKE', '%' . $request->userName . '%');
        if (isset($request->centerID)) $user->where('asahi_center.centerId', $request->centerID);
        if (isset($request->centerName)) $user->where('centerName', 'LIKE', '%' . $request->centerName . '%');

        $user = $user->get();

        if (Auth::user()->roleId != 3) return view('admin.user.result', ['users' => $user]);
    }



    //Thoát tài khoản 
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
