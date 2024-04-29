<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\ChiTietThueSan;
use App\Models\Ve;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chiTietThueSan = ChiTietThueSan::all();
        $veQuantity = ChiTietThueSan::count();
        $doanhThu = 0;
        foreach ($chiTietThueSan as $item) {
            $tongTienVe = Ve::where('id', $item->maVe)->first()->tongTien;
            $doanhThu += $tongTienVe;
        }
        $averagePrice = $doanhThu / $veQuantity;
        $activeUsersCount = User::where('trangThai', '!=', 0)->count();
        return view('Admin.dashboard', compact('activeUsersCount', 'veQuantity', 'doanhThu', 'averagePrice'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
