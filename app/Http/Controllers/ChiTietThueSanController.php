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
use Illuminate\Support\Facades\Auth;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

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
        try {
            $chiTietThueSan = ChiTietThueSan::where('maCTTS', $id)->first();
            // return $chiTietThueSan;
            if (!empty($chiTietThueSan)) {
                $chiTietThueSan->update($request->all());
                return response()->json(['success' => 'Cập nhật chi tiết thành công']);
            } else
                return response()->json(['error' => 'Cập nhật chi tiết thất bại']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Cập nhật chi tiết thất bại']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $chiTietThueSan = ChiTietThueSan::where('maCTTS', $id)->first();
            $result = $chiTietThueSan->delete();
            if (!empty($result))
                return response()->json(['success' => 'Hủy sân thành công.', 'chiTietThueSan' => $chiTietThueSan]);
            else
                return response()->json(['error' => 'Lỗi hủy sân!']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Lỗi hủy sân!']);
        }
    }
    public function formVe()
    {
        $userId = Auth::user()->maNguoiDung;
        // Lấy mã vé từ bảng Ve theo mã người dùng
        $maVeList = Ve::where('maNguoiDung', $userId)->pluck('id');
        $chiTietThueSans = ChiTietThueSan::whereIn('maVe', $maVeList)->orderBy('maCTTS', 'desc')->paginate(5);
        return view('Pages.cart', compact('chiTietThueSans'));
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

        // phpinfo();
        // Dữ liệu để chuyển vào mã QR
        $data = [
            "ve_id" => $ve->id,
            "ho_ten" => $ve->hoTen,
            "sdt" => $ve->SDT,
            "dia_chi" => $ve->diaChi,
            "tong_tien" => number_format($ve->tongTien, 0, ',', '.') . '₫',
            "san_bong_ten" => $sanBong->tenSan,
            "hinh_anh" => $sanBong->hinhAnh,
            "thoi_gian_nhan" => $chiTietThueSan->thoiGianBatDau,
            "thoi_gian_tra" => $chiTietThueSan->thoiGianKetThuc,
        ];

        $json_data = json_encode($data);

        // Tạo mã QR
        $qrCode = new QrCode($json_data);
        $writer = new PngWriter();
        $qrCode->setSize(200);

        // Lưu mã QR vào file
        $qrCodePath = 'qrcodes/qrcode_' . $ve->id . '.png';
        $writer->write($qrCode)->saveToFile(public_path($qrCodePath));
        if ($tongSoGiay < 0) {
            $daSuDung = "Đã sử dụng";
            return view('Pages.detail', compact('chiTietThueSan', 've', 'sanBong', 'daSuDung', 'qrCodePath'));
        }
        return view('Pages.detail', [
            'chiTietThueSan' => $chiTietThueSan,
            've' => $ve,
            'sanBong' => $sanBong,
            'qrCodePath' => $qrCodePath
        ]);
    }
}
