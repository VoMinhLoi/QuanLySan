<?php

namespace App\Http\Controllers\Admin;

use App\Models\ChiTietThueSan;
use App\Http\Controllers\Controller;
use App\Models\SanBong;
use Illuminate\Http\Request;
use App\Models\Ve;
use DateTime;
use DateTimeZone;
use Exception;
use Illuminate\Support\Facades\Mail;

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
    public function store(Request $request)
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
                                <li>ID:  $request->maCTTS đã hủy.</li>
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
}
