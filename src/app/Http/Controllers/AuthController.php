<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function getRegister()
    {
        return view('auth/register');
    }

    public function postRegister(RegisterRequest $request)
    {
        try {
            User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);
            return redirect('thanks');
        } catch (\Throwable $exception) {
            return redirect('register');
        }
    }

    public function thanks()
    {
        return view('thanks');
    }

    public function getLogin()
    {
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
