<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CustomVerifyEmailController;

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

Route::controller(ShopController::class)->group(function () {
    Route::get('/', 'index')->middleware('verified.users')->name('index');
    Route::get('/search', 'search');
    Route::get('/shop/detail', 'detail');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/register', 'getRegister');
    Route::post('/register', 'postRegister');
    Route::get('/email/verify', 'emailVerification')->name('verification.notice');
    Route::get('/thanks', 'thanks');

    Route::get('/login', 'getLogin');
    Route::post('/login', 'postLogin');
    Route::get('/logout', 'getLogout')->middleware('auth');
});

Route::get('/email/verify/{id}/{hash}', [CustomVerifyEmailController::class, 'verifyEmail'])
    ->name('verification.verify');

Route::get('/mypage',  [UserController::class, 'mypage'])->middleware('auth');

Route::controller(ReservationController::class)->middleware('auth')->group(function () {
    Route::post('/reservation/create', 'createReservation');
    Route::post('/reservation/update', 'updateReservation');
    Route::post('/reservation/{reservation_id}', 'deleteReservation')->name('reservation_delete');

    Route::get('/done', 'doneReservation');
    Route::get('/change', 'changeReservation');
});

Route::patch('/favorite/{shop_id}', [FavoriteController::class, 'switchFavoriteStatus'])
    ->middleware('auth');

Route::controller(ReviewController::class)->middleware('auth')->group(function () {
    Route::get('/review/{reservation_id}', 'showReviewForm');
    Route::post('/review', 'createReview');
    Route::get('/done/review', 'doneReview');
    Route::post('/delete/review/{id}', 'deleteReview');

});
