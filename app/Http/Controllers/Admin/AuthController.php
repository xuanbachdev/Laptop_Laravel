<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guard('admin')->check()){
            return to_route('admin.dashboard');
        }
        $title = 'Quản trị hệ thống';
        return view('admin.login', compact('title'));
    }


    public function store(Request $request)
    {
        $remember_me = isset($request->remember_me) ? true : false;
         $this->validate($request, [
           'username' => 'bail|required',
           'password' => 'bail|required|min:8'
        ],
        [
            'username.required' => 'Vui lòng nhập tên đăng nhập',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu có ít nhất 8 ký tự'
         ]);


        if(Auth::guard('admin')->attempt(['username' => $request->username, 'password'=>$request->password], $remember_me)){
            return to_route('admin.dashboard');
        }
        else
        {
            Session::flash('error', 'Tài khoản/ mật khẩu không chính xác. <br/> Vui lòng đăng nhập lại ^^');
            return redirect()->back();
        }
    }

    public function logout()
    {
            Auth::guard('admin')->logout();
            return to_route('admin.login')->with('success', 'Đăng xuất thành công');
    }

}
