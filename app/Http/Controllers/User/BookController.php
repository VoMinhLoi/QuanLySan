<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DungCu;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function interface()
    {
        //     $dungCus = DungCu::whereRaw('soLuongCon - soLuongChoThue >= 1')->where('trangThai', 1)->get();
        return view('Pages.checkout');
    }
}
