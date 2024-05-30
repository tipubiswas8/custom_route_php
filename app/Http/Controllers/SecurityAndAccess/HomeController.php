<?php

namespace App\Http\Controllers\SecurityAndAccess;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SecurityAndAccess\Module;

class HomeController extends Controller
{
    public function index()
    {
        $modules = Module::where(['active_status' => '1', 'type' => '1'])->orderBy('serial', 'ASC')->get();
        return view("security_and_access.home.index", ['modules' => $modules]);
    }
}
