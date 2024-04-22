<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ChiTietThueSan;
use Exception;
use Illuminate\Http\Request;

class ChiTietThueSanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $chiTietThueSan = ChiTietThueSan::all();
            // return $chiTietThueSan;
            if (!empty($chiTietThueSan))
                return $chiTietThueSan;
            else
                return response()->json(['error' => 'Không thể hiện thị tất cả các vé.']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Lỗi tìm vé.']);
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
        // return $request->all();
        try {
            $chiTietThueSan = ChiTietThueSan::create($request->all());
            // return $chiTietThueSan;
            if (!empty($chiTietThueSan))
                return response()->json(['success' => 'Hoàn tất thủ tục 1']);
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
