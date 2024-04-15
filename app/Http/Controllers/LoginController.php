<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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
        if (Auth::attempt($credentials))
            return redirect('/');
        else
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
            // $finduser = User::where('google_id', $user->google_id)->first();

            if ($finduser)
                Auth::login($finduser);
            else {
                $oldUserHasEmailLikeGmail = User::where('taiKhoan', $user->email)->first();
                if ($oldUserHasEmailLikeGmail) {
                    $oldUserHasEmailLikeGmail->update(['google_id' => $user->id]);
                    Auth::login($oldUserHasEmailLikeGmail);
                } else {
                    $newUser = User::create([
                        'ten' => $user->name,
                        'taiKhoan' => $user->email,
                        'google_id' => $user->id,
                        'password' => encrypt('123456789')
                    ]);
                    Auth::login($newUser);
                }
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
        return redirect()->intended('sanbong');
    }
}
