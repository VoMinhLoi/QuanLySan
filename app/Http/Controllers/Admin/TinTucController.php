<?php

namespace App\Http\Controllers\Admin;

use App\Models\TinTuc;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TinTucController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = TinTuc::all();
        return view('admin.tintuc.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
}
