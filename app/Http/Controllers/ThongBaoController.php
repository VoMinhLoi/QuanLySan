<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ThongBao;
use Exception;
use Illuminate\Http\Request;

class ThongBaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ThongBao::all();
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
            $thongBao = ThongBao::create($request->all());
            // return $chiTietThueSan;
            if (!empty($thongBao->id))
                return response()->json(['success' => 'Tạo thông báo thành công.', 'thongBao' => $thongBao->id]);
            else
                return response()->json(['error' => 'Tạo thông báo thất bại']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Tạo thông báo thất bại']);
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
        try {
            $thongBao = ThongBao::where("id", $id)->first();
            $credentials["daXem"] = $request->daXem;
            $result = $thongBao->update($credentials);
            // return $chiTietThueSan;
            if (!empty($result))
                return response()->json(['success' => 'Đã xem']);
            else
                return response()->json(['error' => 'Lỗi xem thông báo']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Lỗi xem thông báo']);
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
