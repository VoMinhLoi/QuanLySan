<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\ChiTietThueSan;
use App\Models\LichSuGiaoDich;
use App\Models\Ve;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Doanh thu từ việc đặt sân
        $chiTietThueSan = ChiTietThueSan::all();
        $veQuantity = ChiTietThueSan::count();
        $doanhThu = 0;
        foreach ($chiTietThueSan as $item) {
            $tongTienVe = Ve::where('id', $item->maVe)->first()->tongTien;
            $doanhThu += $tongTienVe;
        }

        //Tính thêm lợi nhuận từ việc hủy vé
        $chiTietThueSanDaXoa = ChiTietThueSan::onlyTrashed()->get();
        $tongTienVeDaXoa = 0;
        foreach ($chiTietThueSanDaXoa as $item) {
            $tongTienVeDaXoa += Ve::where('id', $item->maVe)->first()->tongTien;
        }
        $loiNhuanTuHuyVe = $tongTienVeDaXoa - LichSuGiaoDich::where('loaiGD', 3)->get()->sum('soTien');

        $averagePrice = $doanhThu / $veQuantity;
        $doanhThu += $loiNhuanTuHuyVe;
        $activeUsersCount = User::where('trangThai', '!=', 0)->count();
        return view('Admin.dashboard', compact('activeUsersCount', 'veQuantity', 'doanhThu', 'averagePrice', 'loiNhuanTuHuyVe'));
    }
}
