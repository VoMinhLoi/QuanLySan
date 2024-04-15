<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('Pages.login');
    }
    public function store(Request $request)
    {
        $credentials['taiKhoan'] = $request->taiKhoan;
        $credentials['password'] = $request->matKhau;
        if (Auth::attempt($credentials))
            return redirect('/');
        else
            return redirect()->back()->withErrors('Tài khoản, mật khẩu không chính xác.');
    }
}
