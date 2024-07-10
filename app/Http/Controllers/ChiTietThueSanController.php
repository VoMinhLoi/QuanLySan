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
use Illuminate\Support\Facades\Mail;

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
    public function sendMail(Request $request)
    {
        try {
            // $data = [
            //     'maCTTS' => $request->maCTTS,
            //     'maSan' => $request->maSan,
            //     'thoiGian' => "từ " . $request->thoiGianBatDau . " đến " . $request->thoiGianKetThuc,
            //     'money' => $request->money
            // ];
            // Mail::send('Pages.calendarform', $data, function ($message) use ($request) {
            //     $message->to($request->taiKhoan)
            //         ->subject("Hủy chi tiết thuê sân " . $request->maCTTS);
            // });
            $htmlContent = "
                    <html>
                        <head>
                            <title>Chi tiết đơn hủy sân</title>
                        </head>
                        <body>
                            <p>Chúng tôi rất tiếc phải thông báo với bạn rằng đặt lịch của bạn với các chi tiết:</p>
                            <ul>
                                <li>ID:  CTTS $request->maCTTS đã hủy.</li>
                                <li>Mã sân:  $request->maSan </li>
                                <li>Thời gian bắt đầu: từ $request->thoiGianBatDau đến $request->thoiGianKetThuc</li>
                                <li>Tổng tiền: " . number_format($request->money, 0, ',', '.') . " <sup>₫</sup> đã được hoàn lại vào số dư tài khoản ngay từ thời điểm gửi mail.</li>
                            </ul>
                            <p>Cảm ơn sự quý khách đã quan tâm.</p>
                            <p><strong>Hỗ trợ kỹ thuật</strong>: minhloi1131130@gmail.com - +84 (0)89 378 634.</p>
                            <p>Địa chỉ: 44 Đ. Dũng Sĩ Thanh Khê, Thanh Khê Tây, Thanh Khê, Đà Nẵng<p>
                            <p>Địa chỉ cá nhân: 02 Thanh Sơn, Thanh Bình, Hải Châu, Đà Nẵng<p>
                        </body>
                    </html>
                ";
            Mail::send([], [], function ($message) use ($request, $htmlContent) {
                $message->to($request->taiKhoan)
                    ->subject("Hủy chi tiết thuê sân " . $request->maCTTS)
                    ->html($htmlContent); // Use the html method to set the HTML content
            });

            return response()->json(['success' => 'Gửi mail thành công.']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Gửi mail thất bại.', 'message' => $e->getMessage()], 500);
        }
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
            "Mã vé" => $ve->id,
            "Họ tên" => $ve->hoTen,
            "Số điện thoại" => $ve->SDT,
            "Địa chỉ" => $ve->diaChi,
            "Tổng tiền" => number_format($ve->tongTien, 0, ',', '.') . '₫',
            "Tên sân bóng" => $sanBong->tenSan,
            "Hình ảnh" => $sanBong->hinhAnh,
            "Thời gian vào sân" => $chiTietThueSan->thoiGianBatDau,
            "Thời gian trả sân" => $chiTietThueSan->thoiGianKetThuc,
        ];

        $json_data = json_encode($data, JSON_UNESCAPED_UNICODE);

        // Tạo mã QR
        $qrCode = new QrCode($json_data);
        $writer = new PngWriter();
        $qrCode->setSize(200);

        // Lưu mã QR vào file
        $qrCodePath = 'qrcodes/qrcode_' . $ve->id . '.png';
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
        $mergedQrCodePath = 'qrcodes/merged_qrcode_' . $ve->id . '.png';
        imagepng($qrCodeImage, public_path($mergedQrCodePath));

        // Giải phóng bộ nhớ
        imagedestroy($qrCodeImage);
        imagedestroy($avatar);

        // Kết quả: Đường dẫn đến hình ảnh mã QR đã được merge
        $mergedQrCodePath;
        if ($tongSoGiay < 0) {
            $daSuDung = "Đã sử dụng";
            return view('Pages.detail', compact('chiTietThueSan', 've', 'sanBong', 'daSuDung', 'mergedQrCodePath'));
        }
        return view('Pages.detail', [
            'chiTietThueSan' => $chiTietThueSan,
            've' => $ve,
            'sanBong' => $sanBong,
            'mergedQrCodePath' => $mergedQrCodePath
        ]);
    }
}
