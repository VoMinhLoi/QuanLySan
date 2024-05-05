<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DungCu;
use Exception;
use Illuminate\Http\Request;

class DungCuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DungCu::all();
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
        if ($request->hasFile('hinhAnh1')) {
            $imageSRC = $request->file('hinhAnh1');
            $imageName = $imageSRC->getClientOriginalName();
            try {
                $imageSRC->move(public_path('assets/img'), $imageName);
            } catch (Exception $e) {
                return response()->json(['error' => 'Tạo dụng cụ thất bại.', 'message' => $e->getMessage()]);
            }
            $sanBongData = $request->except('hinhAnh1');
            $sanBongData['hinhAnh1'] = $imageName;
            DungCu::create($sanBongData); // không có mã sân chèn vào
            $currentNews = DungCu::orderBy('maDungCu', 'desc')->first(); //lấy thêm mã sân ra
            return response()->json(['success' => 'Tạo dụng cụ mới thành công.', 'currentNews' => $currentNews]);
        } else {
            DungCu::create($request->all());
            $currentNews = DungCu::orderBy('maDungCu', 'desc')->first(); //lấy thêm mã sân ra
            return response()->json(['success' => 'Tạo dụng cụ mới thành công.', 'currentNews' => $currentNews]);
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
            $newsIsUpdated = DungCu::where('maDungCu', $id)->first();
            $credentials['tenDungCu'] = $request->tenDungCu;
            $credentials['soLuongCon'] = $request->soLuongCon;
            $credentials['moTa'] = $request->moTa;
            $credentials['donGiaGoc'] = $request->donGiaGoc;
            $credentials['donGiaThue'] = $request->donGiaThue;
            $credentials['trangThai'] = $request->trangThai;
            // $credentials['thoiGian'] = $request->thoiGian;
            $newsIsUpdated->update($credentials);
            // return $newsIsUpdated;
            return response()->json(['success' => 'Cập nhật tin tức thành công.', 'newsIsUpdated' => $newsIsUpdated]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Cập nhật tin tức thất bại.', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DungCu::where('maDungCu', $id)->first()->delete();
            return response()->json(['success' => 'Xóa dụng cụ thành công.']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Xóa dụng cụ thất bại.', 'message' => $e->getMessage()]);
        }
    }
}
