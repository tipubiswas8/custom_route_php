<?php

namespace App\Http\Controllers\SecurityAndAccess;

use App\Http\Controllers\Controller;
use App\Models\SecurityAndAccess\Module;
use App\Models\SecurityAndAccess\ModuleLink;

class HomeController extends Controller
{
    public function index()
    {
        $modules = Module::where(['active_status' => '1', 'type' => '1'])->orderBy('serial', 'ASC')->get();
        foreach ($modules as $module) {
            $moduleLink[] = ModuleLink::where(['active_status' => '1', 'link_type' => 1, 'module_id' => $module->id])->first();
        }
        return view("security_and_access.home.index", ['modules' => $modules, 'moduleLink' => $moduleLink]);
    }
}
