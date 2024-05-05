<?php

namespace App\Http\Controllers\admin;

use App\Models\DungCu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DungCuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dungCus = DungCu::all();
        return view('admin.dungcu.index', compact('dungCus'));
    }
}
