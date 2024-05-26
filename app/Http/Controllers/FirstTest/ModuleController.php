<?php

namespace App\Http\Controllers\FirstTest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FirstTest\ModuleModel;
use App\Models\FirstTest\ModuleLinkModel;
use Illuminate\Support\Facades\DB;

class ModuleController extends Controller
{
    //

    public function moduleIndex()
    {
        $modules = ModuleModel::where(['type' => '1'])->orderBy('serial', 'ASC')->get();
        return view("first-test.module", ['modules' => $modules]);
    }

    public function moduleCreate()
    {
        return view("first-test.module_create");
    }


    public function moduleStore(Request $request)
    {
        $name = $request->name;
        $serial = $request->serial;
        $icon = $request->icon;
        $status = $request->status;
        try {
            $insert = ModuleModel::create([
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

        $module = ModuleModel::find($id);
        return view("first-test.module_edit", ['module' => $module]);
    }



    public function moduleUpdate(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $serial = $request->serial;
        $icon = $request->icon;
        $status = $request->status;
        try {
            $update = ModuleModel::where('id', $id)->update([
                'name' => $name,
                'icon' => $icon,
                'serial' => $serial,
                'active_status' => $status
            ]);

            if ($update) {
                DB::commit();
                return redirect()->back()->with("success", "Module Update Successfully!xx");
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
            $statusChange = ModuleModel::where('id', $id)->update([
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
            $update = ModuleModel::where('id', $id)->delete();
            DB::commit();
            return redirect()->back()->with("success", "Module Delete Successfully!");
        } catch (\Exception $e) {
            dd($e);
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
        $module = ModuleModel::where(['active_status' => '1', 'type' => '1', 'id' => $id])->first();
        $moduleRoute = ModuleLinkModel::select(['url', 'name', 'request_type'])->where(['link_type' => '1', 'module_id' => $module->id])->first();
        $mainMenus = ModuleModel::where(['active_status' => '1', 'type' => '2', 'parent_module_id' => $module->id])->orderBy('serial', 'ASC')->get();
        foreach ($mainMenus as $mm) {
            $subMenus = ModuleModel::where(['active_status' => '1', 'type' => '3', 'parent_module_id' => $mm->parent_module_id, 'parent_menu_id' => $mm->id])->orderBy('serial', 'ASC')->get();
            $mainMenuRoute = ModuleLinkModel::where(['link_type' => '2', 'module_id' => $module->id, 'main_menu_id' => $mm->id])->get();
            foreach ($subMenus as $subMenu) {
                $subMenuRoute[] = ModuleLinkModel::where(['link_type' => '3', 'module_id' => $module->id, 'main_menu_id' => $mm->id, 'sub_menu_id' => $subMenu->id])->get();
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

    public function menuCreate(Request $request)
    {
        if ($_GET)
            if ($request->type == 2) {
                $id = $request->id;
                $type = $request->type;
                return view("first-test.create", [
                    'id' => $id,
                    'type' => $type,
                ]);
            }

        if ($request->type == 3) {
            $id = $request->id;
            $type = $request->type;
            $mainMenu = ModuleModel::where(['active_status' => '1', 'type' => '2', 'parent_module_id' => $id])->get();
            return view("first-test.create", [
                'id' => $id,
                'type' => $type,
                'mainMenu' => $mainMenu,
            ]);
        }

        $modules = ModuleModel::where(['type' => '1'])->get();
        $buttonStatus = "Next";
        $type = 1;
        return view("first-test.create", [
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
            $insert = ModuleModel::create([
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
}