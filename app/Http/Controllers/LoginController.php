<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\LichSuGiaoDich;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function index()
    {
        return view('Pages.login');
    }

    public function login(Request $request)
    {

        $credentials['taiKhoan'] = $request->taiKhoan;
        $credentials['password'] = $request->matKhau;
        if (Auth::attempt($credentials)) {
            // $user = User::where('taiKhoan', $request->taiKhoan)->first();
            if (Auth::user()->trangThai)
                if (Auth::user()->maQuyen == 1)
                    return redirect('/customer');
                else
                    return redirect('/sanbong');
            else
                return back()->withErrors(['message' => "Tài khoản đã bị vô hiệu hóa."]);
        } else
            return redirect()->back()->withErrors('Tài khoản, mật khẩu không chính xác.');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {
                if ($finduser->trangThai) {
                    // Đăng nhập người dùng đã tồn tại
                    $token = $finduser->createToken('authToken')->plainTextToken;
                    Auth::login($finduser);
                    if (Auth::user()->maQuyen == 1)
                        return redirect('/customer');
                } else
                    return redirect('/dangnhap')->withErrors(['message' => "Tài khoản đã bị vô hiệu hóa."]);
            } else {
                $oldUserHasEmailLikeGmail = User::where('taiKhoan', $user->email)->first();

                if ($oldUserHasEmailLikeGmail) {
                    if ($oldUserHasEmailLikeGmail->trangThai) {
                        // Cập nhật thông tin Google ID cho người dùng có email tương tự
                        $oldUserHasEmailLikeGmail->update(['google_id' => $user->id]);
                        $token = $oldUserHasEmailLikeGmail->createToken('authToken')->plainTextToken;
                        Auth::login($oldUserHasEmailLikeGmail);
                        if (Auth::user()->maQuyen == 1)
                            return redirect('/customer');
                    } else
                        return redirect('/dangnhap')->withErrors(['message' => "Tài khoản đã bị vô hiệu hóa."]);
                } else {
                    // Tạo người dùng mới nếu không có người dùng nào tồn tại với email tương tự
                    $newUser = User::create([
                        'ten' => $user->name,
                        'taiKhoan' => $user->email,
                        'google_id' => $user->id,
                        'password' => bcrypt('1234567')
                    ]);
                    $token = $newUser->createToken('authToken')->plainTextToken;
                    Auth::login($newUser);
                    if (Auth::user()->maQuyen == 1)
                        return redirect('/customer');
                }
            }

            // Tạo và lưu token vào cơ sở dữ liệu
        } catch (Exception $e) {
            dd($e->getMessage());
        }
        return redirect()->intended('sanbong');
    }
    public function formForgot()
    {
        return view('Pages.forgot');
    }
    public function forgot(UserRequest $request)
    {
        $user = User::where('taiKhoan', $request->validated()['taiKhoan'])->first();
        if ($user) {
            //tạo token có độ dài 64 ký tự 
            $token = Str::random(64);

            //thêm dữ liệu vào bảng password_reset_tokens
            DB::table('password_reset_tokens')->insert([
                'email' => $user->taiKhoan, //lưu địa chỉ mail từ request
                'token' => $token, //lưu token đc tạo ra ở trên
                'created_at' => Carbon::now() //lưu thời điểm tạo token
            ]);
            //gửi email thông báo đặt lại mk 
            //fe.email-forgot-password và token sẽ được chuyển đến view
            //trong URL đc gửi đến email, có token được truyền qua URL
            //sau đó sẽ so sánh token trong url có trùng khớp với token trong database ko
            //có thì sẽ cho phép đổi mật khẩu
            Mail::send('Elements.buttonreset', ['token' => $token], function ($message) use ($request) {
                $message->to($request->taiKhoan);
                $message->subject("Reset Password");
            });
            session()->flash('json_message', 'Gửi email thành công và hãy kiểm tra mail');
            return redirect()->back();
        } else
            return redirect()->back()->withErrors(['message' => 'Email không tồn tại']);
    }
    public function formResetPassword($token)
    {
        return view('Pages.reset', compact('token'));
    }
    public function resetPassword(Request $request)
    {
        $updatePassword = DB::table('password_reset_tokens')
            ->where([
                'token' => $request->token,
            ])->first();

        //ko tồn tại thì hiển thị lỗi
        if (!$updatePassword) {
            return redirect()->to(route("reset.password"))->withErrors("error", "Không đúng xác minh mã mail");
        }
        // dd();
        // cập nhật mật khẩu mới trong bảng users
        User::where("taiKhoan", $updatePassword->email)
            ->update(["password" => bcrypt($request->password)]);
        //xóa token khỏi bảng reset_passwords
        DB::table("password_reset_tokens")->where(["token" => $request->token])->delete();
        //chuyển hướng đến trang login
        return redirect()->to(route("formLogin"))->with("json_message", "Mật khẩu đã được cài lại");
    }
    public function formProfile()
    {
        return view('Pages.profile');
    }
    public function formRechargeVNPay(Request $request)
    {
        $vnp_OrderInfo = "Nạp tiền qua ví điện tử VNPay";

        $vnp_Amount = 0;
        $vnp_TxnRef = rand(1000, 99999);
        if ($request->has('soTien')) {
            $vnp_Amount = $request->input('soTien') * 100;
        }
        // dd($request->input('totalPrice'));
        // Sử dụng dd để kiểm tra giá trị của 'idVe' và 'ndck'
        if ($request->has('idVe')) {
            // Lấy giá trị của 'idVe' và 'ndck' từ yêu cầu
            // $ndck = $request->input('ndck');
            // $vnp_OrderInfo = $ndck;
            $idVe = $request->input('idVe');
            $totalPrice = $request->input('totalPrice');
            $vnp_TxnRef = $idVe;
            $totalPriceNumeric = (int) str_replace(['.', ',', '₫', ' '], '', $totalPrice);
            $vnp_Amount = $totalPriceNumeric * 100;
        }
        // dd($idVe, $ndck, $totalPrice);

        // Chuyển đổi giá trị totalPrice thành số nguyên biểu diễn cho số tiền
        // dd($vnp_TxnRef, $vnp_OrderInfo, $vnp_Amount);
        // }
        $urlRedict = "http://127.0.0.1:8000/redirect_vnpay_payment";
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = $urlRedict;
        $vnp_TmnCode = "0DAQZHR2"; //Mã website tại VNPAY 
        $vnp_HashSecret = "QCKWGCSVLEITSWLYTVIXAKJPYWUWWFCW"; //Chuỗi bí mật

        //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        // $vnp_TxnRef = $_POST['order_id']; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        // 
        $vnp_OrderType = 'billpayment';
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
        // vui lòng tham khảo thêm tại code demo
    }
    public function formRedirectVNPay()
    {
        return view('Pages.insertmoneyandhistory');
    }
    public function formRecharge()
    {
        $lichSuGiaoDich = LichSuGiaoDich::where('maNguoiDung', Auth::user()->maNguoiDung)->get();
        return view('Pages.recharge', ['lichSuGiaoDich' => $lichSuGiaoDich]);
    }
}
