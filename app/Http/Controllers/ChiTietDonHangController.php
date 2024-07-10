<?php

namespace App\Http\Controllers;

use App\Models\ChiTietDonHang;
use App\Http\Controllers\Controller;
use App\Models\DonHang;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Exception;
use Illuminate\Http\Request;

class ChiTietDonHangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function formChiTietDonHang(string $maDonHang)
    {
        $chiTietDonHangs = ChiTietDonHang::where('maDonHang', $maDonHang)->get();
        $donHang = DonHang::where('id', $maDonHang)->first();

        // Dữ liệu để chuyển vào mã QR
        $data = [
            "Mã đơn hàng" => $donHang->id,
            "Họ và tên" => $donHang->hoTen,
            "Số điện thoại" => $donHang->sdt,
            "Địa chỉ" => $donHang->diaChi,
            "Tổng tiền" => number_format($donHang->tongTien, 0, ',', '.') . '₫',
            "Tổng số món" => $chiTietDonHangs->count(),
            "Thời gian đặt" => $donHang->ngayDatHang,
            "Giảm giá" => $donHang->giamGia,
            "Ghi chú" => $donHang->ghiChu,
        ];

        // Encode JSON data with JSON_UNESCAPED_UNICODE option
        $json_data = json_encode($data, JSON_UNESCAPED_UNICODE);

        // Tạo mã QR
        $qrCode = new QrCode($json_data);
        $writer = new PngWriter();
        $qrCode->setSize(200);

        // Lưu mã QR vào file
        $qrCodePath = 'qrcodes/qrcode_' . $donHang->id . '.png';
        $writer->write($qrCode)->saveToFile(public_path($qrCodePath));
        $avatarPath = public_path('Logo-Truong-Dai-hoc-The-duc-The-thao-Da-Nang.png');

        // Đọc hình ảnh avatar
        $avatar = imagecreatefrompng($avatarPath);

        // Đọc hình ảnh mã QR
        $qrCodeImage = imagecreatefrompng(public_path($qrCodePath));

        // Lấy kích thước của hình ảnh mã QR và avatar
        $qrCodeWidth = imagesx($qrCodeImage);
        $qrCodeHeight = imagesy($qrCodeImage);
        $avatarWidth = imagesx($avatar);
        $avatarHeight = imagesy($avatar);

        // Tính toán vị trí để đặt avatar vào giữa mã QR
        $x = ($qrCodeWidth - $avatarWidth) / 2;
        $y = ($qrCodeHeight - $avatarHeight) / 2;

        // Merge hình ảnh avatar vào mã QR
        imagecopymerge($qrCodeImage, $avatar, $x, $y, 0, 0, $avatarWidth, $avatarHeight, 70);

        // Lưu hình ảnh mã QR đã được merge vào file mới
        $mergedQrCodePath = 'qrcodes/merged_qrcode_' . $donHang->id . '.png';
        imagepng($qrCodeImage, public_path($mergedQrCodePath));

        // Giải phóng bộ nhớ
        imagedestroy($qrCodeImage);
        imagedestroy($avatar);

        // Kết quả: Đường dẫn đến hình ảnh mã QR đã được merge
        return view('Pages.orderDetail', compact('chiTietDonHangs', 'donHang', 'mergedQrCodePath'));
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
            ChiTietDonHang::create($request->all());
            return response()->json(['success' => 'Tạo chi tiết đơn hàng thành công.']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Tạo chi tiết đơn hàng thất bại.', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ChiTietDonHang $chiTietDonHang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ChiTietDonHang $chiTietDonHang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ChiTietDonHang $chiTietDonHang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChiTietDonHang $chiTietDonHang)
    {
        //
    }
}
