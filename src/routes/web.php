<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReviewController;

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

include __DIR__ . '/admin.php';
include __DIR__ . '/manager.php';

Route::controller(ShopController::class)->middleware(['verified.users'])->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/search', 'search');
    Route::get('/shop/detail', 'detail');
});

Route::controller(AuthController::class)->middleware(['verified.users'])->group(function () {
    Route::get('/register', 'getRegister');
    Route::post('/register', 'postRegister');
    Route::get('/thanks', 'thanks');

    Route::get('/login', 'getLogin');
    Route::post('/login', 'postLogin');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/email/verify', 'emailVerification')->name('verification.notice');
    Route::get('/logout', 'getLogout');
});

Route::controller(UserController::class)->middleware(['verified.users'])->group(function () {
    Route::get('/mypage', 'mypage');
});

Route::controller(ReservationController::class)->middleware(['verified.users'])->group(function () {
    Route::post('/reservation/create', 'createReservation');
    Route::post('/reservation/update', 'updateReservation');
    Route::post('/reservation/{reservation_id}', 'deleteReservation')->name('reservation_delete');

    Route::get('/done', 'doneReservation');
    Route::get('/change', 'changeReservation');
});

Route::controller(FavoriteController::class)->middleware(['verified.users'])->group(function () {
    Route::patch('/favorite/{shop_id}', 'switchFavoriteStatus');
});

Route::controller(ReviewController::class)->middleware(['verified.users'])->group(function () {
    Route::get('/review/{reservation_id}', 'showReviewForm');
    Route::post('/review', 'createReview');
    Route::get('/done/review', 'doneReview');
});
