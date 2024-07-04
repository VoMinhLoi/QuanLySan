<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DungCu;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class DungCuController extends Controller
{
    public function interface()
    {
        return view('Pages.tool');
    }
    public function index()
    {
        return DungCu::where('trangThai', 1)->get();
    }
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
    public function show(string $id)
    {
        return DungCu::where('maDungCu', $id)->first();
    }
    public function update(Request $request, string $id)
    {
        try {
            $dungCu = DungCu::where('maDungCu', $id)->firstOrFail();

            if ($request->has('soLuongChoThue')) {
                $dungCu->soLuongChoThue += intval($request->input('soLuongChoThue'));
                $dungCu->save();
                return response()->json(['success' => 'Cập nhật dụng cụ thành công.']);
            }

            // Validate input data here if needed

            $dungCu->update($request->all());
            return response()->json(['success' => 'Cập nhật dụng cụ thành công.', 'newsIsUpdated' => $dungCu]);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Cập nhật dụng cụ thất bại.', 'message' => $e->getMessage()], 500);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Cập nhật dụng cụ thất bại.', 'message' => $e->getMessage()], 500);
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
    public function formToolDetail(string $id)
    {
        $dungCu = DungCu::where('maDungCu', $id)->first();
        return view('Pages.toolDetail', compact('dungCu'));
    }
}
