<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FirstTest\ModuleModel;


class HomeController extends Controller
{
    //

    public function index()
    {  
        $modules = ModuleModel::where(['active_status' => '1', 'type' => '1'])->orderBy('serial', 'ASC')->get();
        return view("home.home", ['modules' => $modules]);
    }
    
}