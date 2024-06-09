<?php

namespace App\Http\Controllers\Admin;

use App\Models\LichSuGiaoDich;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LichSuGiaoDichController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lichSuGiaoDich = LichSuGiaoDich::orderBy('id', 'desc')->paginate(7);
        return view('admin.lichsugiaodich.index', compact('lichSuGiaoDich'));
    }
}
