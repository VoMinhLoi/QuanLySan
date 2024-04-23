<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ChiTietThueSan;
use App\Models\SanBong;
use App\Models\Ve;
use DateTime;
use DateTimeZone;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class ChiTietThueSanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $chiTietThueSan = ChiTietThueSan::all();
            // return $chiTietThueSan;
            if (!empty($chiTietThueSan))
                return $chiTietThueSan;
            else
                return response()->json(['error' => 'Không thể hiện thị tất cả các vé.']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Lỗi tìm vé.']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();
        try {
            $chiTietThueSan = ChiTietThueSan::create($request->all());
            // return $chiTietThueSan;
            if (!empty($chiTietThueSan))
                return response()->json(['success' => 'Hoàn tất thủ tục 1']);
            else
                return response()->json(['error' => 'Có lỗi khi hoàn tất thủ tục']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Lỗi chi tiết thuê sân']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $chiTietThueSan = ChiTietThueSan::where('maCTTS', $id)->first();
            // return $chiTietThueSan;
            if (!empty($chiTietThueSan))
                return $chiTietThueSan;
            else
                return response()->json(['error' => 'Lỗi xem chi tiết']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Lỗi xem chi tiết']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function formVe()
    {
        return view('Pages.cart');
    }
    public function formDetail($maCTTS)
    {
        $chiTietThueSan = ChiTietThueSan::where('maCTTS', $maCTTS)->first();
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
        if ($tongSoGiay < 0)
            return view('Pages.detail', ['chiTietThueSan' => $chiTietThueSan, 've' => $ve, 'sanBong' => $sanBong, "daSuDung" => "Đã sử dụng"]);

        return view('Pages.detail', [
            'chiTietThueSan' => $chiTietThueSan,
            've' => $ve,
            'sanBong' => $sanBong,
        ]);
    }
}
