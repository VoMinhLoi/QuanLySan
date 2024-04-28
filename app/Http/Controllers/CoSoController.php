<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CoSo;
use Exception;
use Illuminate\Http\Request;

class CoSoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CoSo::all();
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
            $credentials['tenCoSo'] = $request->tenCoSo;
            $credentials['diaChi'] = $request->diaChi;
            $credentials['moTa'] = $request->moTa;
            $credentials['maPX'] = $request->maPX;
            $credentials['thoiGianMoCua'] = $request->thoiGianMoCua;
            $credentials['thoiGianDongCua'] = $request->thoiGianDongCua;
            CoSo::create($credentials);
            $newCoSo = CoSo::orderBy('maCoSo', 'desc')->first();
            return response()->json(['success' => 'Tạo cơ sở thành công.', 'newCoSo' => $newCoSo]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Tạo cơ sở thất bại.', 'message' => $e->getMessage()]);
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
            $branchIsUpdated = CoSo::where('maCoSo', $id)->first();
            $credentials['tenCoSo'] = $request->tenCoSo;
            $credentials['diaChi'] = $request->diaChi;
            $credentials['moTa'] = $request->moTa;
            // $credentials['maPX'] = $request->maPX;
            $credentials['thoiGianMoCua'] = $request->thoiGianMoCua;
            $credentials['thoiGianDongCua'] = $request->thoiGianDongCua;
            $branchIsUpdated->update($credentials);
            // return $branchIsUpdated;
            return response()->json(['success' => 'Cập nhật cơ sở thành công.', '$branchIsUpdated' => $branchIsUpdated]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Cập nhật cơ sở thất bại.', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            CoSo::where('maCoSo', $id)->first()->delete();
            return response()->json(['success' => 'Xóa cơ sở thành công.']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Xóa cơ sở thất bại.', 'message' => $e->getMessage()]);
        }
    }
}
