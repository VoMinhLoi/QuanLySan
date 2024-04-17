<?php

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/sanbong', [App\Http\Controllers\SanBongController::class, 'interface']);
Route::get('/lienhe', [App\Http\Controllers\User\ContactController::class, 'index']);
Route::get('/dieukhoanchinhsach', [App\Http\Controllers\User\PoliciesAndTermsController::class, 'index']);


Route::get('/dangky', [RegisterController::class, 'index']);
Route::get('/dangnhap', [LoginController::class, 'index'])->name('formLogin');
Route::post('/dangnhap', [LoginController::class, 'store'])->name('login');
Route::get('/auth/google', [LoginController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback']);
Route::get('/quenmatkhau', [LoginController::class, 'formForgot']);
Route::post('/quenmatkhau', [LoginController::class, 'forgot'])->name('user.forgot');
Route::get('/cailaimatkhau/{token}', [LoginController::class, 'formResetPassword']);
Route::post('/cailaimatkhau', [LoginController::class, 'resetPassword'])->name('user.resetPassword');


Route::group(['middleware' => 'userLogin'], function () {
    Route::get('/thuesan', [BookController::class, 'interface']);
    Route::get('/hosocanhan', [LoginController::class, 'formProfile']);
    Route::get('/dangxuat', [LogoutController::class, 'index']);
});
