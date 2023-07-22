<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use tidy;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }
    public function checkLogin(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'password' => 'required'
        ]);
        $credentials = $request->only('code', 'password');
        if (auth()->guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.home');
        } else {
            return redirect()->route('admin.login')->with('error', 'الكود او الرقم السري غير صحيح');
        }
    }

    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
