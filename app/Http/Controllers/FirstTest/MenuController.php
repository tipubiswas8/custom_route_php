<?php

namespace App\Http\Controllers\FirstTest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FirstTest\ModuleModel;

class MenuController extends Controller
{
    //

    public function menuIndex()
    {
        $menus = ModuleModel::orderBy('serial', 'ASC')->get();
        $allMenus = [];
        $modules = [];
        foreach ($menus as $menu) {
            $parentModule = ModuleModel::select('name')->where(['type' => '1', 'id' => $menu->parent_module_id])->get();
            $parentMenus = ModuleModel::select('id', 'name')->where(['type' => '2', 'id' => $menu->parent_menu_id])->get();
            if ($menu->type != 2 && $menu->type != 3) {
                continue;
            }
            $allMenus[] = $menu;

            foreach ($parentModule as $module) {
                $modules[] = $module->name;
            }
            foreach ($parentMenus as $pm) {
                $parentMenu[] = $pm->name;
            }
        }

        return view("first-test.menu", ['menus' => $allMenus, 'modules' => $modules, 'parentMenu' => $parentMenu]);
    }
}