<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use App\Http\Controllers\Controller;
use App\Models\ChiTietDonHang;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DonHangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return DonHang::all();
        } catch (Exception $e) {
            return response()->json(['error' => 'Tạo đơn hàng thất bại.', 'message' => $e->getMessage()], 500);
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
        try {
            $donHang = DonHang::create($request->all());
            $phuongXa = \App\Models\PhuongXa::where('maPhuongXa', $donHang->maPX)->first();
            $quanHuyen = \App\Models\QuanHuyen::where('maQuanHuyen', $phuongXa->maQH)->first();
            $tenTTNow = \App\Models\TinhThanh::where('maTinhThanh', $quanHuyen->maTT)->first()['tenTinhThanh'];
            $methodPay = "";
            if ($request->phuongThucThanhToan === 1)
                $methodPay = "thanh toán online.";
            else
                $methodPay = "thanh toán khi nhận đơn.";
            $isPaid = "";
            if ($request->daThanhToan)
                $isPaid = "đã thanh toán";
            else
                $isPaid = "chưa thanh toán";
            $htmlContent = "
            <html>
                <head>
                    <title>Đặt đơn hàng thành công.</title>
                </head>
                <body>
                    <p>Thông tin các chi tiết:</p>
                    <ul>
                        <li>Mã đơn hàng: $donHang->id</li>
                        <li>Mã người đặt:  ND" . $request->maNguoiDung . "</li>
                        <li>Họ tên: $request->hoTen</li>
                        <li>Địa chỉ giao: $request->diaChi, $phuongXa->tenPhuongXa, $quanHuyen->tenQuanHuyen, $tenTTNow </li>
                        <li>Số điện thoại: $request->sdt</li>
                        <li>Giảm được: " . number_format($request->giamGia, 0, ',', '.') . " <sup>₫</sup>.</li>
                        <li>Tổng tiền: " . number_format($request->tongTien, 0, ',', '.') . " <sup>₫</sup>.</li>
                        <li>Phương thức thanh toán: $methodPay</li>
                        <li>Trạng thái: $isPaid</li>
                        <li>Ghi chú: $request->ghiChu</li>
                    </ul>
                    <p>Cảm ơn sự quý khách đã quan tâm.</p>
                    <p><strong>Hỗ trợ kỹ thuật</strong>: minhloi1131130@gmail.com - +84 (0)89 378 634.</p>
                    <p>Địa chỉ: 44 Đ. Dũng Sĩ Thanh Khê, Thanh Khê Tây, Thanh Khê, Đà Nẵng<p>
                    <p>Địa chỉ cá nhân: 02 Thanh Sơn, Thanh Bình, Hải Châu, Đà Nẵng<p>
                </body>
            </html>
            ";
            Mail::send([], [], function ($message) use ($request, $htmlContent) {
                $message->to(User::where('maNguoiDung', $request->maNguoiDung)->first()->taiKhoan)
                    ->subject("Đặt đơn hàng thành công.")
                    ->html($htmlContent); // Use the html method to set the HTML content
            });
            return response()->json(['success' => 'Tạo đơn hàng, gửi mail thành công.', 'maDonHang' => $donHang->id]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Tạo đơn hàng thất bại.', 'message' => $e->getMessage()], 500);
        }
    }
    public function formDonHang()
    {
        try {
            $userId = Auth::user()->maNguoiDung;
            // Lấy mã vé từ bảng Ve theo mã người dùng
            // $maDonHangList = DonHang::where('maNguoiDung', $userId)->pluck('id');
            // $chiTietDonHangs = ChiTietDonHang::whereIn('maDonHang', $maDonHangList)->orderBy('id', 'desc')->paginate(5);
            $donHangList = DonHang::where('maNguoiDung', $userId)->orderBy('id', 'desc')->paginate(5);
            return view('Pages.order', compact('donHangList'));
        } catch (Exception $e) {
            return response()->json(['error' => 'Tạo đơn hàng thất bại.', 'message' => $e->getMessage()], 500);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(DonHang $donHang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DonHang $donHang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DonHang $donHang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DonHang $donHang)
    {
        //
    }
}
