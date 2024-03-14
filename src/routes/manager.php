<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manager\ShopController;
use App\Http\Controllers\Manager\CustomVerifyEmailController;
use App\Http\Controllers\Manager\LoginController;
use App\Http\Controllers\Manager\ReservationController;
use App\Http\Controllers\Manager\ReviewController;

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

Route::prefix('manager')->controller(ShopController::class)->middleware('auth.managers:managers')->group(
    function () {
        Route::get('/index', 'index')->middleware('verified.managers')->name('manager.index');
        Route::get('/create', 'create');
        Route::post('/store', 'store');
        Route::get('/edit', 'edit');
        Route::post('/update', 'update');
    }
);

Route::prefix('manager')->controller(CustomVerifyEmailController::class)->group(
    function () {
        Route::get('/email/verify', 'emailVerification');
        Route::get('/email/verify/{id}/{hash}', 'verifyEmail')->name('manager.verification.verify');
        Route::get('/thanks', 'thanks');
    }
);

Route::prefix('manager')->controller(LoginController::class)->group(
    function () {
        Route::get('/login', 'getLogin')->name('manager.login');
        Route::post('/login', 'postLogin');
        Route::get('/logout', 'getLogout')->middleware('auth.managers:managers');
    }
);

Route::prefix('manager')->controller(ReservationController::class)->middleware('auth.managers:managers')->group(
    function () {
        Route::get('/reservation', 'showReservation');
        Route::get('/reception/{reservation_id}', 'markVisitedFlag');
        Route::get('/done/reception', 'doneReception');
    }
);

Route::prefix('manager')->controller(ReviewController::class)->middleware('auth.managers:managers')->group(
    function () {
        Route::get('/review', 'showReview');
    }
);
