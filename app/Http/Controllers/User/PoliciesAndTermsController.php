<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PoliciesAndTermsController extends Controller
{
    public function index()
    {
        return view('Pages.terms_policies');
    }
}
