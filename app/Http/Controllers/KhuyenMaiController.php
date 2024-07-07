<?php

namespace App\Http\Controllers;

use App\Models\KhuyenMai;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class KhuyenMaiController extends Controller
{
    public function formKhuyenMai()
    {
        $khuyenMais = KhuyenMai::where('trangThai', 1)->get();
        return view('Pages.discount', compact('khuyenMais'));
    }
    public function show(string $id)
    {
        try {
            $khuyenMai = KhuyenMai::where('maKhuyenMai', $id)->first();
            return $khuyenMai;
        } catch (Exception $e) {
            return response()->json(['error' => 'Mã khuyến mãi không tồn tại.', 'message' => $e->getMessage()], 500);
        }
    }
}
