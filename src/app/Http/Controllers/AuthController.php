<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function getRegister()
    {
        return view('auth/register');
    }

    public function postRegister(RegisterRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);
            event(new Registered($user));
            return redirect('/email/verify');
        } catch (\Throwable $exception) {
            return redirect('/register')->with('error-message', '登録中にエラーが発生しました');
        }
    }

    public function emailVerification()
    {
        return view('auth/verify-email');
    }

    public function thanks()
    {
        return view('thanks');
    }

    public function getLogin()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('auth/login');
    }

    public function postLogin(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return redirect('/');
        } else {
            return redirect('login');
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect("/");
    }
}
