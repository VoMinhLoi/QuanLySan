<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ThueSan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThueSanController extends Controller
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
        $maNguoiDung = $request->maNguoiDung;
        try {
            // Kiểm tra xem mã sân đã có trong túi của người dùng này chưa
            $sportFieldExist = ThueSan::where('maSan', $request->maSan)
                ->where('maNguoiDung', $maNguoiDung)
                ->first();
            if (!empty($sportFieldExist))
                return response()->json(['error' => 'Sân đã có trong túi']);
            $credentials['maNguoiDung'] = $maNguoiDung;

            $credentials['maSan'] = $request->maSan;
            $credentials['soLuong'] = $request->soLuong;
            $credentials['thoiGianBatDau'] = $request->thoiGianBatDau;
            $credentials['thoiGianKetThuc'] = $request->thoiGianKetThuc;
            $credentials['trangThai'] = $request->trangThai;
            $credentials['thu'] = $request->thu;
            $credentials['ngay'] = $request->ngay;
            $item = ThueSan::create($credentials);
            // return $item;
            if ($item)
                return response()->json(['success' => 'Bạn đã thêm vào túi thành công']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Thêm vào túi thất bại']);
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
