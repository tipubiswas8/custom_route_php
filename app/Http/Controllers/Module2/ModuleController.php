<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Module\Module;
use App\Models\Module\ModuleLink;
use Illuminate\Support\Facades\DB;

class ModuleController extends Controller
{
    public function moduleIndex()
    {
        $modules = Module::where(['type' => '1'])->orderBy('serial', 'ASC')->get();
        return view("module.index", ['modules' => $modules]);
    }

    public function moduleCreate()
    {
        return view("module.create");
    }

    public function moduleStore(Request $request)
    {
        $name = $request->name;
        $serial = $request->serial;
        $icon = $request->icon;
        $status = $request->status;
        try {
            $insert = Module::create([
                'name' => $name,
                'type' => '1',
                'icon' => $icon,
                'serial' => $serial,
                'parent_menu_id' => '',
                'active_status' => $status
            ]);
            DB::commit();
            return redirect()->back()->with("success", "Module Create Successfully!");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with("error", $e . " Something want wrong!, please try again");
        }
    }

    public function moduleEdit($id)
    {
        $module = Module::find($id);
        return view("module.edit", ['module' => $module]);
    }

    public function moduleUpdate(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $serial = $request->serial;
        $icon = $request->icon;
        $status = $request->status;
        try {
            $update = Module::where('id', $id)->update([
                'name' => $name,
                'icon' => $icon,
                'serial' => $serial,
                'active_status' => $status
            ]);

            if ($update) {
                DB::commit();
                return redirect()->back()->with("success", "Module Update Successfully!");
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with("error", $e . " Something want wrong!, please try again");
        }
    }

    public function moduleStatus(Request $request)
    {
        $id = array_keys($request->query->all())[0];
        $status = $request->status;
        try {
            $statusChange = Module::where('id', $id)->update([
                'active_status' => $status
            ]);
            DB::commit();
            return redirect()->back()->with("success", "Module Status Update Successfully!");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with("error", $e . " Something want wrong!, please try again");
        }
    }

    public function moduleDelete(Request $request)
    {
        $id = array_keys($request->query->all())[0];
        try {
            $update = Module::where('id', $id)->delete();
            DB::commit();
            return redirect()->back()->with("success", "Module Delete Successfully!");
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return redirect()->back()->with("error", $e . " Something want wrong!, please try again");
        }
    }

    public function menuIndex()
    {
        $menus = Module::orderBy('serial', 'ASC')->get();
        $allMenus = [];
        $modules = [];
        foreach ($menus as $menu) {
            $parentModule = Module::select('name')->where(['type' => '1', 'id' => $menu->parent_module_id])->get();
            $parentMenus = Module::select('id', 'name')->where(['type' => '2', 'id' => $menu->parent_menu_id])->get();
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

        return view("menu.index", ['menus' => $allMenus, 'modules' => $modules, 'parentMenu' => $parentMenu]);
    }



    public function menuCreate(Request $request)
    {
        if ($_GET)
            if ($request->type == 2) {
                $id = $request->id;
                $type = $request->type;
                return view("menu.create", [
                    'id' => $id,
                    'type' => $type,
                ]);
            }

        if ($request->type == 3) {
            $id = $request->id;
            $type = $request->type;
            $mainMenu = Module::where(['active_status' => '1', 'type' => '2', 'parent_module_id' => $id])->get();
            return view("menu.create", [
                'id' => $id,
                'type' => $type,
                'mainMenu' => $mainMenu,
            ]);
        }

        $modules = Module::where(['type' => '1'])->get();
        $buttonStatus = "Next";
        $type = 1;
        return view("menu.create", [
            'modules' => $modules,
            'buttonStatus' => $buttonStatus,
            'type' => $type,
        ]);
    }

    public function menuStore(Request $request)
    {
        $name = $request->name;
        $type = $request->type;
        $serial = $request->serial;
        $icon = $request->icon;
        $parent_module_id  = $request->id;
        $parent_menu_id  = $request->parent_menu_id;
        $status = $request->status;

        try {
            $insert = Module::create([
                'name' => $name,
                'type' => $type,
                'serial' => $serial,
                'icon' => $icon,
                'parent_module_id' => $parent_module_id,
                'parent_menu_id' => $parent_menu_id ? $parent_menu_id : '',
                'active_status' => $status
            ]);
            DB::commit();
            return redirect()->back()->with("success", "Module Create Successfully!");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with("error", $e . " Something want wrong!, please try again");
        }
    }

    public function path($id)
    {
        $mmRoutes = array();
        $mainMenuRoute = [];
        $subMenuRoute  = [];
        $smRoutes = [];
        $module = Module::where(['active_status' => '1', 'type' => '1', 'id' => $id])->first();
        $moduleRoute = ModuleLink::select(['url', 'name', 'request_type'])->where(['link_type' => '1', 'module_id' => $module->id])->first();
        $mainMenus = Module::where(['active_status' => '1', 'type' => '2', 'parent_module_id' => $module->id])->orderBy('serial', 'ASC')->get();
        foreach ($mainMenus as $mm) {
            $subMenus = Module::where(['active_status' => '1', 'type' => '3', 'parent_module_id' => $mm->parent_module_id, 'parent_menu_id' => $mm->id])->orderBy('serial', 'ASC')->get();
            $mainMenuRoute = ModuleLink::where(['link_type' => '2', 'module_id' => $module->id, 'main_menu_id' => $mm->id])->get();
            foreach ($subMenus as $subMenu) {
                $subMenuRoute[] = ModuleLink::where(['link_type' => '3', 'module_id' => $module->id, 'main_menu_id' => $mm->id, 'sub_menu_id' => $subMenu->id])->get();
                $sMenus[] = $subMenu;
            }
            foreach ($mainMenuRoute as $row) {
                $mmRoutes[] = $row;
            }
        }

        foreach ($subMenuRoute as $row) {
            $smRoutes[] = $row;
        }

        foreach ($mmRoutes as $value) {
            $mmRoute[] = $value;
        }

        foreach ($smRoutes as $values) {
            foreach ($values as $value) {
                $smRoute[] = $value;
            }
        }

       // dd($moduleRoute);
        return view('admin.dashboard.index', [
            'module' => $module,
            'mainMenus' => $mainMenus,
            'sMenus' => $sMenus ?? [],
            'moduleRoute' => $moduleRoute ?? (object) ['request_type' => 'get'],
            'mmRoute' => $mmRoute ?? [],
            'smRoute' => $smRoute ?? []
        ]);
    }
}
