<?php

namespace App\Http\Controllers\Admin;

use App\Models\CoSo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoSoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coso = CoSo::all();
        return view('admin.coso.index', compact('coso'));
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
    public function show(CoSo $coSo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CoSo $coSo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CoSo $coSo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CoSo $coSo)
    {
        //
    }
}
