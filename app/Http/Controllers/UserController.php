<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
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
            $credentials['ho'] = $request->surname;
            $credentials['ten'] = $request->name;
            $credentials['taiKhoan'] = $request->email;
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
            if ($newUser)
                return response()->json(['success' => 'Bạn đã đăng ký thành công']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Email đã tồn tại']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
}