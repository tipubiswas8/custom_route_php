<?php

namespace App\Http\Controllers\Acc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Mm1ForAccountController extends Controller
{
    //

    public function mmOne()
    {
        return view('acc.mm1_for_account');
    }
}