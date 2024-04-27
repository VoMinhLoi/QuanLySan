<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChiTietThueSanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\User\BookController;
use App\Models\ChiTietThueSan;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/lienhe', [App\Http\Controllers\User\ContactController::class, 'index']);
Route::get('/dieukhoanchinhsach', [App\Http\Controllers\User\PoliciesAndTermsController::class, 'index']);


Route::get('/dangky', [RegisterController::class, 'index']);
Route::get('/dangnhap', [LoginController::class, 'index'])->name('formLogin');
Route::post('/dangnhap', [LoginController::class, 'login'])->name('login');
Route::get('/auth/google', [LoginController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback']);
Route::get('/quenmatkhau', [LoginController::class, 'formForgot']);
Route::post('/quenmatkhau', [LoginController::class, 'forgot'])->name('user.forgot');
Route::get('/cailaimatkhau/{token}', [LoginController::class, 'formResetPassword']);
Route::post('/cailaimatkhau', [LoginController::class, 'resetPassword'])->name('user.resetPassword');


Route::group(['middleware' => 'userLogin'], function () {
    Route::get('/sanbong', [App\Http\Controllers\SanBongController::class, 'interface']);
    Route::get('/thuesan', [BookController::class, 'interface']);
    Route::get('/hosocanhan', [LoginController::class, 'formProfile']);
    Route::get('/tui', [ChiTietThueSanController::class, 'formVe']);
    Route::get('/chitietthuesan/{chitietthuesan}', [ChiTietThueSanController::class, 'formDetail']);
    Route::get('/dangxuat', [LogoutController::class, 'index']);
    Route::post('/vnpay_payment', [LoginController::class, 'formRechargeVNPay']);
    Route::get('/redirect_vnpay_payment', [LoginController::class, 'formRedirectVNPay']);
    Route::get('/naptien', [LoginController::class, 'formRecharge']);
});

Route::group(['middleware' => 'adminLogin'], function () {
    Route::group(['prefix' => '/customer'], function () {
        Route::resource('', 'App\Http\Controllers\Admin\UserController');
    });
});
