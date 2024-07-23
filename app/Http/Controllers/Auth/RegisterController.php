<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index() {
        // hiển thị view đăng ký
//        dd('trang đăng ký');
        return view('auth.register');
    }

    public function register(Request $request) {
        // xử lý logic đăng ký
//        dd($request->all());
        $data = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'email'=> ['required', 'string', 'email', 'max:100', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        // tạo tài khoản
        $user = User::query()->create($data);
        // Login bằng tk user vừa tạo
        Auth::login($user);
        // generate lại token
        $request->session()->regenerate();
        return redirect()->intended('/');
    }
}
