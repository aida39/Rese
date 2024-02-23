<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Manager;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    public function getRegister()
    {
        return view('admin/index');
    }

    public function postRegister(RegisterRequest $request)
    {
        try {
            Manager::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);
            return redirect('admin/thanks');
        } catch (\Throwable $exception) {
            return redirect('admin/register');
        }
    }

    public function thanks()
    {
        return view('admin/thanks');
    }
}