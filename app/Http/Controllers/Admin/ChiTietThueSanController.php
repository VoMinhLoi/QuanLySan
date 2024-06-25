<?php

namespace App\Http\Controllers\Admin;

use App\Models\ChiTietThueSan;
use App\Http\Controllers\Controller;
use App\Models\SanBong;
use Illuminate\Http\Request;
use App\Models\Ve;
use DateTime;
use DateTimeZone;

class ChiTietThueSanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $chiTietThueSan = ChiTietThueSan::withTrashed()->(desc)->paginate(5);
        $chiTietThueSan = ChiTietThueSan::withTrashed()->orderBy('maCTTS', 'desc')->paginate(5);
        return view('admin.chitietthuesan.index', compact('chiTietThueSan'))->with('i', (request()->input('page', 1) - 1) * 5);
        // return view('admin.chitietthuesan.index', compact('chiTietThueSan'));
    }
    public function show(String $id)
    {
        $chiTietThueSan = ChiTietThueSan::where('maCTTS', $id)->first();
        $ve = Ve::where('id', $chiTietThueSan->maVe)->first();
        $sanBong = SanBong::where('maSan', $chiTietThueSan->maSan)->first();

        // Tính biến đã sử dụng
        $timezone = new DateTimeZone('Asia/Ho_Chi_Minh');
        $batDau = new DateTime($chiTietThueSan->thoiGianBatDau, $timezone);
        $hienTai = new DateTime('now', $timezone);
        $khoangCach = $hienTai->diff($batDau); // This will give you the difference in days
        $ngay = $khoangCach->days;
        $gio = $khoangCach->h;
        $phut = $khoangCach->i;
        $giay = $khoangCach->s;

        // Tính tổng số giây
        $tongSoGiay = $ngay * 86400 + $gio * 3600 + $phut * 60 + $giay;
        if ($khoangCach->invert === 1) {
            $tongSoGiay *= -1;
        }
        if ($tongSoGiay < 0) {
            $daSuDung = "Đã sử dụng";
            return view('admin.chitietthuesan.detail', compact('chiTietThueSan', 've', 'sanBong', 'daSuDung'));
        }
        return view('admin.chitietthuesan.detail', compact('chiTietThueSan', 've', 'sanBong'));
    }
}
