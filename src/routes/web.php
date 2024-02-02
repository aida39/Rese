<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

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

Route::controller(CustomerController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/search', 'search');
        Route::patch('/favorite/{shop_id}', 'switchFavoriteStatus');
        Route::get('/detail', 'detail');

        Route::get('/thanks','thanks');
        Route::get('/menu/guest', 'guestMenu');
    }
);