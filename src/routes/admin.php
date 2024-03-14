<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\MailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->controller(RegisterController::class)->middleware('auth.admins:admins')->group(
    function () {
        Route::get('/index', 'getRegister')->name('admin.index');
        Route::post('/register', 'postRegister');
        Route::get('/thanks', 'thanks');
    }
);

Route::prefix('admin')->controller(LoginController::class)->group(
    function () {
        Route::get('/login', 'getLogin')->name('admin.login');
        Route::post('/login', 'postLogin');
        Route::get('/logout', 'getLogout')->middleware('auth.admins:admins');
    }
);

Route::prefix('admin')->controller(MailController::class)->middleware('auth.admins:admins')->group(
    function () {
        Route::get('/mail', 'showMailForm');
        Route::post('/mail', 'sendMail');
        Route::get('/done/mail', 'doneMail');
    }
);
