<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ve;
use Exception;
use Illuminate\Http\Request;

class VeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $tickets = Ve::all();
            return $tickets;
        } catch (Exception $e) {
            return response()->json('error', 'Tải vé không thành công');
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
            $ve = Ve::create($request->all());
            return response()->json(['success' => 'Vé đã có trong túi và đợi hoàn tất thủ tục', 'idVe' => $ve->id]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Đặt vé thất bại']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $ve = Ve::where('id', $id)->first();
            return $ve;
        } catch (Exception $e) {
            return response()->json(['error' => 'Không tìm thấy thông tin vé']);
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
