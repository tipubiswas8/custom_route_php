<?php

namespace App\Http\Controllers\SecurityAndAccess;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SecurityAndAccessController extends Controller
{
    //

    public function index()
    {
        return view('security_and_access.index');
    }
}