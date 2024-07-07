<?php

use App\Http\Controllers\ChiTietThueSanController;
use App\Http\Controllers\CoSoController;
use App\Http\Controllers\DungCuController;
use App\Http\Controllers\GioHangController;
use App\Http\Controllers\KhuyenMaiController;
use App\Http\Controllers\LichSuGiaoDichController;
use App\Http\Controllers\SanBongController;
use App\Http\Controllers\TinhThanhController;
use App\Http\Controllers\QuanHuyenController;
use App\Http\Controllers\PhuongXaController;
use App\Http\Controllers\ThongBaoController;
use App\Http\Controllers\ThueSanController;
use App\Http\Controllers\TinTucController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('coso', CoSoController::class);
Route::apiResource('sanbong', SanBongController::class);
Route::apiResource('user', UserController::class);
Route::apiResource('tinhthanh', TinhThanhController::class);
Route::apiResource('quanhuyen', QuanHuyenController::class);
Route::apiResource('phuongxa', PhuongXaController::class);
Route::apiResource('thuesan', ThueSanController::class);
Route::apiResource('ve', VeController::class);
Route::apiResource('chitietthuesan', ChiTietThueSanController::class);
Route::apiResource('lichsugiaodich', LichSuGiaoDichController::class);
Route::apiResource('tintuc', TinTucController::class);
Route::apiResource('thongbao', ThongBaoController::class);
Route::apiResource('dungcu', DungCuController::class);
Route::apiResource('giohang', GioHangController::class);
Route::apiResource('khuyenmai', KhuyenMaiController::class);
