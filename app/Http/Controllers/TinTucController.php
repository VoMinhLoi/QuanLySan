<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TinTuc;
use Exception;
use Illuminate\Http\Request;

class TinTucController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function formTinTuc($maTin)
    {
        // dd($maTin);
        $tinTuc = TinTuc::where('id', $maTin)->first();
        $tinTuc->luotXem += 1;
        $tinTuc->save(); // Use save() to update the model
        return view('Pages.news', compact('tinTuc'));
    }
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
        if ($request->hasFile('hinhAnh')) {
            $imageSRC = $request->file('hinhAnh');
            $imageName = $imageSRC->getClientOriginalName();
            try {
                $imageSRC->move(public_path('assets/img'), $imageName);
            } catch (Exception $e) {
                return response()->json(['error' => 'Tạo tin tức thất bại.', 'message' => $e->getMessage()]);
            }
            $sanBongData = $request->except('hinhAnh');
            $sanBongData['hinhAnh'] = $imageName;
            TinTuc::create($sanBongData); // không có mã sân chèn vào
            $currentNews = TinTuc::orderBy('id', 'desc')->first(); //lấy thêm mã sân ra
            return response()->json(['success' => 'Tạo tin tức mới thành công.', 'currentNews' => $currentNews]);
        } else {
            TinTuc::create($request->all());
            $currentNews = TinTuc::orderBy('id', 'desc')->first(); //lấy thêm mã sân ra
            return response()->json(['success' => 'Tạo tin tức mới thành công.', 'currentNews' => $currentNews]);
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $newsIsUpdated = TinTuc::where('id', $id)->first();
            $credentials['tieuDe'] = $request->tieuDe;
            $credentials['lienKetNgoai'] = $request->lienKetNgoai;
            $credentials['moTa'] = $request->moTa;
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
            TinTuc::where('id', $id)->first()->delete();
            return response()->json(['success' => 'Xóa tin tức thành công.']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Xóa tin tức thất bại.', 'message' => $e->getMessage()]);
        }
    }
}
