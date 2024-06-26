<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            $credentials['ho'] = $request->ho;
            $credentials['ten'] = $request->ten;
            $credentials['taiKhoan'] = $request->taiKhoan;
            $credentials['password'] = bcrypt($request->password);
            // Cách 1 đơn giản, đẩy thẳng vào cơ sở dữ liệu
            // $newUser = DB::table('nguoidung')->insert(
            //     [
            //         'ho' => $credentials['ho'],
            //         'ten' => $credentials['ten'],
            //         'taiKhoan' => $credentials['taiKhoan'],
            //         'password' => $credentials['password']
            //     ]
            // );
            // Cách 2 phải tạo ra bảng ghi User xong đẩy vào cơ sở dữ liệu, phải bật thêm $fillable vs $timestamps
            $newUser = User::create($credentials);
            // $token = $newUser->createToken('Token Name')->accessToken;
            if ($newUser)
                return response()->json(['success' => 'Bạn đã đăng ký thành công', 'maNguoiDung' => $newUser->maNguoiDung]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Email đã tồn tại']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $user = User::where('maNguoiDung', $id)->first();
            return $user;
        } catch (Exception $e) {
            return response()->json(['message' => 'Không tìm thấy người dùng.'], 404);
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
        $userIsUpdated = User::where('maNguoiDung', $id)->first();
        // return $userIsUpdated;
        // Usecase change password
        if (!empty($request->oldPassword)) {
            // Auth::user()->password không thể sử dụng vì trả về null
            $userPassword = $userIsUpdated->password;
            // return $userPassword;
            if (password_verify($request->oldPassword, $userPassword)) {
                $userIsUpdated->update(['password' => bcrypt($request->password)]);
                return  response()->json(['success' => 'Đổi mật khẩu thành công']);
            } else
                return response()->json(['error' => 'Mật khẩu cũ không đúng']);
        } else {
            // Refund - Hoàn tiền
            if (!empty($request->soDuTaiKhoan)) {
                $result = $userIsUpdated->update([
                    'soDuTaiKhoan' => $userIsUpdated->soDuTaiKhoan + $request->soDuTaiKhoan
                ]);
                if (isset($result))
                    return response()->json(['success' => 'Hoàn tiền thành công.']);
                else
                    return response()->json(['error' => 'Hoàn tiền thất bại.']);
            } else
                // Mở khóa và vô hiệu hóa tài khoản
                if (isset($request->trangThai)) {
                    $credentials['trangThai'] = $request->trangThai;
                    $result = $userIsUpdated->update($credentials);
                    if ($result)
                        if ($userIsUpdated->trangThai == 0)
                            return response()->json(['warning' => 'Vô hiệu hóa thành công']);
                        else
                            return response()->json(['success' => 'Mở khóa tài khoản thành công']);
                    else
                        return response()->json(['error' => 'Lỗi chuyển trạng thái tài khoản thất bại.']);
                } else
                    // Cấp quyền người dùng
                    if (isset($request->maQuyen)) {
                        $credentials['maQuyen'] = $request->maQuyen;
                        $result = $userIsUpdated->update($credentials);
                        if ($result)
                            return response()->json(['success' => 'Cấp quyền thành công thành công']);
                        else
                            return response()->json(['error' => 'Lỗi cấp quyền.']);
                    } else {
                        // Usecase update private information
                        $credentials['ho'] = $request->ho;
                        $credentials['ten'] = $request->ten;
                        if (!empty($request->ngaySinh)) {
                            $ngaySinhFormatted = Carbon::createFromFormat('d-m-Y', $request->ngaySinh)->format('Y-m-d');
                            $credentials['ngaySinh'] = $ngaySinhFormatted;
                        }

                        $credentials['cccd'] = $request->cccd;
                        $credentials['SDT'] = $request->SDT;
                        $credentials['maPX'] = $request->maPX;
                        $credentials['diaChi'] = $request->diaChi;
                        $result = $userIsUpdated->update($credentials);
                        if ($result)
                            return response()->json(['success' => 'Cập nhật thông tin thành công']);
                        else
                            return response()->json(['error' => 'Cập nhật thông tin thất bại']);
                    }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
