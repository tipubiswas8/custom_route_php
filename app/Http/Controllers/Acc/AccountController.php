<?php

namespace App\Http\Controllers\Acc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    //

    public function index()
    {
        return view('acc.index');
    }

    public function accCreate()
    {
        echo 'from Acc/AccountController accCreate method';
    }
}