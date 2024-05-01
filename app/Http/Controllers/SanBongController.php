<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CoSo;
use App\Models\SanBong;
use Exception;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SanBongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function interface()
    {
        $coSo = CoSo::where('maCoSo', 'COSO001')->first();
        $gioMoCua = $coSo->thoiGianMoCua;
        $gioDongCua = $coSo->thoiGianDongCua;
        $soGioThue = $gioDongCua - $gioMoCua;
        return view('Pages.book', compact('gioMoCua', 'gioDongCua', 'soGioThue'));
    }

    public function index()
    {
        try {
            $sanbong = SanBong::all();
            return $sanbong;
        } catch (ExceptionHandler $e) {
            return response()->json(['message' => 'Lỗi tải Category về.'], Response::HTTP_NOT_FOUND);
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
        if ($request->hasFile('hinhAnh')) {
            $imageSRC = $request->file('hinhAnh');
            $imageName = $imageSRC->getClientOriginalName();
            try {
                $imageSRC->move(public_path('assets/img'), $imageName);
            } catch (Exception $e) {
                return response()->json(['error' => 'Tạo sân bóng thất bại.', 'message' => $e->getMessage()]);
            }
            $sanBongData = $request->except('hinhAnh');
            $sanBongData['hinhAnh'] = $imageName;
            SanBong::create($sanBongData); // không có mã sân chèn vào
            $newPitch = SanBong::orderBy('maSan', 'desc')->first(); //lấy thêm mã sân ra
            return response()->json(['success' => 'Tạo sân bóng mới thành công.', 'newPitch' => $newPitch]);
        } else {
            SanBong::create($request->all());
            $newPitch = SanBong::orderBy('maSan', 'desc')->first(); //lấy thêm mã sân ra
            return response()->json(['success' => 'Tạo sân bóng mới thành công.', 'newPitch' => $newPitch]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $sanbong = SanBong::where('maSan', $id)->first();
            return $sanbong;
        } catch (ExceptionHandler $e) {
            return response()->json(['message' => 'Không tìm thấy sân bóng.'], Response::HTTP_NOT_FOUND);
        }
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
            $pitchIsUpdated = SanBong::where('maSan', $id)->first();
            $credentials['tenSan'] = $request->tenSan;
            $credentials['viTri'] = $request->viTri;
            $credentials['moTa'] = $request->moTa;
            $credentials['giaDichVu'] = $request->giaDichVu;
            // $credentials['loaiSan'] = $request->loaiSan;
            $credentials['trangThai'] = $request->trangThai;
            $pitchIsUpdated->update($credentials);
            // return $pitchIsUpdated;
            return response()->json(['success' => 'Cập nhật sân bóng thành công.', 'pitchIsUpdated' => $pitchIsUpdated]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Cập nhật sân bóng thất bại.', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            SanBong::where('maSan', $id)->first()->delete();
            return response()->json(['success' => 'Xóa sân bóng thành công.']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Xóa sân bóng thất bại.', 'message' => $e->getMessage()]);
        }
    }
}
