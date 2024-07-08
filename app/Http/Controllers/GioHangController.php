<?php

namespace App\Http\Controllers;

use App\Models\GioHang;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GioHangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return GioHang::all();
        } catch (Exception $e) {
            return response()->json(['error' => 'Hiện thị giỏ hàng thất bại.', 'message' => $e->getMessage()], 500);
        }
    }
    public function formCart()
    {
        try {

            $gioHang = GioHang::where('maNguoiDung', Auth::user()->maNguoiDung)->get();
            return view('Pages.toolCart', compact("gioHang"));
        } catch (Exception $e) {
            return response()->json(['error' => 'Hiện thị giỏ hàng thất bại.', 'message' => $e->getMessage()], 500);
        }
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
            GioHang::create($request->all());
            return response()->json(['success' => 'Tạo giỏ hàng thành công.']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Tạo giỏ hàng thất bại.', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(GioHang $gioHang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GioHang $gioHang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::table('giohang')->where('id', $id)->update($request->all());
            return response()->json(['success' => 'Cập nhật giỏ hàng thành công.']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Cập nhật giỏ hàng thất bại.', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::table('giohang')->where('id', $id)->delete();
            return response()->json(['success' => 'Xóa món hàng thành công.']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Xóa món hàng thất bại.', 'message' => $e->getMessage()], 500);
        }
    }
}
