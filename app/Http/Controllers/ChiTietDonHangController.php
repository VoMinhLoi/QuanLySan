<?php

namespace App\Http\Controllers;

use App\Models\ChiTietDonHang;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class ChiTietDonHangController extends Controller
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
            ChiTietDonHang::create($request->all());
            return response()->json(['success' => 'Tạo chi tiết đơn hàng thành công.']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Tạo chi tiết đơn hàng thất bại.', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ChiTietDonHang $chiTietDonHang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ChiTietDonHang $chiTietDonHang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ChiTietDonHang $chiTietDonHang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChiTietDonHang $chiTietDonHang)
    {
        //
    }
}
