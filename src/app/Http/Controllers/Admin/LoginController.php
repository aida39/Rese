<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function getLogin()
    {
        if (Auth::guard('admins')->user()) {
            return redirect()->route('admin.index');
        }
        return view('admin/login');
    }

    public function postLogin(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (Auth::guard('admins')->attempt($credentials)) {
            return redirect('admin/index');
        } else {
            return redirect('admin/login');
        }
    }

    public function getLogout(Request $request)
    {
        Auth::guard('admins')->logout();
        $request->session()->regenerateToken();
        return redirect("admin/login");
    }
}
