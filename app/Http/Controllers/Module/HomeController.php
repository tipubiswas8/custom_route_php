<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Module\Module;

class HomeController extends Controller
{
    public function index()
    {
        $modules = Module::where(['active_status' => '1', 'type' => '1'])->orderBy('serial', 'ASC')->get();
        return view("home.index", ['modules' => $modules]);
    }
    
}