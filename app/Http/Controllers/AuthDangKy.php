<?php

namespace App\Http\Controllers;

use App\Http\Requests\DangKyRequest;
use App\Http\Requests\DangNhapRequest;


use App\Mail\WelcomeMail;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


use Illuminate\Support\Facades\Mail;


class AuthDangKy extends Controller
{
    public function dangky()
    {
        return view('auth.dangnhap');
    }
    public function postdangky(DangKyRequest $request)
    {

        // User::create([

        $user =  User::create([

            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ]);




        Mail::to($user->email)->queue(new WelcomeMail($user));



        return back()->with('message', 'Đăng ký thành công');
    }
    public function dangnhap()
    {
        return view('auth.dangnhap');
    }
    public function postdangnhap(DangNhapRequest $request)
    {

        $ktra = $request->only('email', 'password');
        if (Auth::attempt($ktra)) {
            $request->session()->regenerate();
            //nếu khớp trả về trang người dùng định truy cập trước đó (Nếu có) hoặc về trang chủ
            return redirect()->intended('/');
        }
        return back()->withErrors([
            'email' => 'Lỗi! Email hoặc mật khẩu không khớp'
        ]);
    }
    public function dangxuat(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
