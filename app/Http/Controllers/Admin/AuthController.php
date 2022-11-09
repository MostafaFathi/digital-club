<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        if (auth('web')->check()) {
            return redirect('/admin');
        }
        return view('admin.auth.login');
    }

    public function login(AdminLoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect('/admin');
    }
    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect(route('admin.login.show'));
    }
}
