<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AuthController;

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

Route::controller(CustomerController::class)->group(
    function () {
        Route::get('/', 'index');
        Route::get('/search', 'search');
        Route::get('/shop/detail', 'detail');
        Route::get('/mypage', 'mypage');
        Route::get('/thanks', 'thanks');
        Route::get('/done', 'done');

        Route::post('/reservation/create', 'createReservation');
        Route::post('/reservation/update', 'updateReservation');
        Route::post('/reservation/delete', 'deleteReservation');
        Route::patch('/favorite/{shop_id}', 'switchFavoriteStatus');
    }
);

Route::controller(AuthController::class)->group(
    function () {
        Route::get('/register', 'getRegister');
        Route::post('/register', 'postRegister');
        Route::get('/login', 'getLogin');
        Route::post('/login', 'postLogin');
        Route::get('/logout', 'getLogout');
    }
);
