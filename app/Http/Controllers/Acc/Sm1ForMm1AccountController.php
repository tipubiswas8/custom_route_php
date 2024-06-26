<?php

namespace App\Http\Controllers\Acc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Sm1ForMm1AccountController extends Controller
{
    //

    public function smOneMmOneAc()
    {
        return view('acc.sm1_for_mm1_account');
    }
}