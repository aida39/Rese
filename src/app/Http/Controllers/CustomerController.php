<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function thanks()
    {
        return view('thanks');
    }

    public function guestMenu()
    {
        return view('menu_guest');
    }
}
