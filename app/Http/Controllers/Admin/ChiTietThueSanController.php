<?php

namespace App\Http\Controllers\Admin;

use App\Models\ChiTietThueSan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChiTietThueSanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chiTietThueSan = ChiTietThueSan::withTrashed()->get();

        return view('admin.chitietthuesan.index', compact('chiTietThueSan'));
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
}
