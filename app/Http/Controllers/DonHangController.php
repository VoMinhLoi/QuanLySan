<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class DonHangController extends Controller
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
            $donHang = DonHang::create($request->all());
            return response()->json(['success' => 'Tạo đơn hàng thành công.', 'maDonHang' => $donHang->id]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Tạo đơn hàng thất bại.', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DonHang $donHang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DonHang $donHang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DonHang $donHang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DonHang $donHang)
    {
        //
    }
}
