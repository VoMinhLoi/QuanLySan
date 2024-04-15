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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/sanbong', [App\Http\Controllers\SanBongController::class, 'interface']);
Route::get('/lienhe', [App\Http\Controllers\User\ContactController::class, 'index']);
Route::get('/dieukhoanchinhsach', [App\Http\Controllers\User\PoliciesAndTermsController::class, 'index']);


Route::get('/dangky', [App\Http\Controllers\RegisterController::class, 'index']);
Route::get('/dangnhap', [App\Http\Controllers\LoginController::class, 'index']);
Route::post('/dangnhap', [App\Http\Controllers\LoginController::class, 'store'])->name('login');
Route::get('/dangxuat', [App\Http\Controllers\LogoutController::class, 'index']);
Route::group(['middleware' => 'userLogin'], function () {
    Route::get('/thuesan', [App\Http\Controllers\User\BookController::class, 'interface']);
});
Route::get('/auth/google', [App\Http\Controllers\LoginController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [App\Http\Controllers\LoginController::class, 'handleGoogleCallback']);
