<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LichSuGiaoDich;
use Exception;
use Illuminate\Http\Request;

class LichSuGiaoDichController extends Controller
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
        // return $request->all();
        try {
            $lichSuGiaoDich = LichSuGiaoDich::create($request->all());
            // return $chiTietThueSan;
            if (!empty($lichSuGiaoDich->id))
                return response()->json(['success' => 'Hoàn tất thủ tục 2', 'idLichSuGiaoDich' => $lichSuGiaoDich->id]);
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
            $lichSuGiaoDich = LichSuGiaoDich::where("id", $id)->first();
            $credentials["trangThai"] = $request->trangThai;
            $result = $lichSuGiaoDich->update($credentials);
            // return $chiTietThueSan;
            if (!empty($result))
                return response()->json(['success' => 'Đã trừ tiền']);
            else
                return response()->json(['error' => 'Lỗi tiền']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Lỗi tiền']);
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
