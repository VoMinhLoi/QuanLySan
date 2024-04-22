<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
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
    public function store(Request $request)
    {
        $credentials['taiKhoan'] = $request->taiKhoan;
        $credentials['password'] = $request->matKhau;
        if (Auth::attempt($credentials)) {
            $user = User::where('taiKhoan', $request->taiKhoan)->first();

            return redirect('/sanbong');
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
                // Đăng nhập người dùng đã tồn tại
                $token = $finduser->createToken('authToken')->plainTextToken;
                Auth::login($finduser);
            } else {
                $oldUserHasEmailLikeGmail = User::where('taiKhoan', $user->email)->first();
                if ($oldUserHasEmailLikeGmail) {
                    // Cập nhật thông tin Google ID cho người dùng có email tương tự
                    $oldUserHasEmailLikeGmail->update(['google_id' => $user->id]);
                    $token = $oldUserHasEmailLikeGmail->createToken('authToken')->plainTextToken;
                    Auth::login($oldUserHasEmailLikeGmail);
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
}
