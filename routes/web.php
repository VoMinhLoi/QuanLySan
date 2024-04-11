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


Route::get('/datsan', [App\Http\Controllers\User\BookController::class, 'index']);
Route::get('/lienhe', [App\Http\Controllers\User\ContactController::class, 'index']);
Route::get('/dieukhoanchinhsach', [App\Http\Controllers\User\PoliciesAndTermsController::class, 'index']);
