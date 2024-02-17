<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function getLogin()
    {
        if (Auth::guard('managers')->user()) {
            return redirect()->route('manager.index');
        }
        return view('manager/login');
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (Auth::guard('managers')->attempt($credentials)) {
            return redirect('manager/index');
        } else {
            return redirect('manager/login');
        }
    }

    public function getLogout(Request $request)
    {
        Auth::guard('managers')->logout();
        $request->session()->regenerateToken();
        return redirect("manager/login");
    }
}
