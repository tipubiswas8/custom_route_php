<?php

namespace App\Http\Controllers\SecurityAndAccess;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SecurityAndAccess\Module;
use App\Models\SecurityAndAccess\ModuleLink;
use App\Models\SecurityAndAccess\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;


class ModuleLinkController extends Controller
{
    public function linkIndex()
    {
        $moduleLink = ModuleLink::orderBy('id', 'DESC')->paginate(10);
        return view("security_and_access.module_link.index", ['moduleLink' => $moduleLink]);
    }

    public function linkCreate(Request $request)
    {
        if ($_GET)
            if ($request->link_type == 1) {
                $modules = Module::where(['type' => '1'])->get();
                $step = 2;
                return view("security_and_access.module_link.create", [
                    'step' => $step,
                    'modules' => $modules,
                ]);
            }

        if ($request->step == 3) {
            $module_id = $request->module_id;
            $step = 3;
            $folder = null;
            // without this check query injection occur in here.
            if ($module_id) {
                $existingController = ModuleLink::select('controller')->where('module_id', $module_id)->first();
                if ($existingController != null) {
                    $exController = ModuleLink::select('controller')->where('module_id', $module_id)->first()->controller;
                    $position = strpos($exController, '\\');
                    $folder = $position == false ? null : substr($exController, 0, $position);
                }
            }
            $permissions = Permission::all();
            return view("security_and_access.module_link.create", [
                'step' => $step,
                'module_id' => $module_id,
                'folder' => $folder,
                'existingController' => $existingController ?? '',
                'permissions' => $permissions
            ]);
        }

        if ($request->link_type == 2) {
            $modules = Module::where(['type' => '1'])->get();
            $step = 4;
            return view("security_and_access.module_link.create", [
                'step' => $step,
                'modules' => $modules,
            ]);
        }

        if ($request->step == 5) {
            $module_id = $request->module_id;
            $mainMenu = Module::where(['active_status' => '1', 'type' => '2', 'parent_module_id' => $module_id])->get();
            $step = 5;
            $folder = null;
            // without this check query injection occur in here.
            if ($module_id) {
                $existingController = ModuleLink::select('controller')->where('module_id', $module_id)->first();
                if ($existingController != null) {
                    $exController = ModuleLink::select('controller')->where('module_id', $module_id)->first()->controller;
                    $position = strpos($exController, '\\');
                    $folder = $position == false ? null : substr($exController, 0, $position);
                }
            }
            $permissions = Permission::all();
            return view("security_and_access.module_link.create", [
                'step' => $step,
                'module_id' => $module_id,
                'mainMenu' => $mainMenu,
                'folder' => $folder,
                'existingController' => $existingController ?? '',
                'permissions' => $permissions
            ]);
        }

        if ($request->link_type == 3) {
            $modules = Module::where(['type' => '1'])->get();
            $step = 6;
            return view("security_and_access.module_link.create", [
                'step' => $step,
                'modules' => $modules,
            ]);
        }

        if ($request->step == 7) {
            $module_id = $request->module_id;
            $mainMenu = Module::where(['active_status' => '1', 'type' => '2', 'parent_module_id' => $module_id])->get();
            $step = 7;
            return view("security_and_access.module_link.create", [
                'step' => $step,
                'module_id' => $module_id,
                'mainMenu' => $mainMenu
            ]);
        }

        if ($request->step == 8) {
            $module_id = $request->module_id;
            $main_menu = $request->main_menu;
            $step = 8;
            $folder = null;
            $subMenu = Module::where(['active_status' => '1', 'type' => '3', 'parent_module_id' => $module_id, 'parent_menu_id' => $main_menu])->get();
            // without this check query injection occur in here.
            if ($module_id) {
                $existingController = ModuleLink::select('controller')->where('module_id', $module_id)->first();
                if ($existingController != null) {
                    $exController = ModuleLink::select('controller')->where('module_id', $module_id)->first()->controller;
                    $position = strpos($exController, '\\');
                    $folder = $position == false ? null : substr($exController, 0, $position);
                }
            }
            $permissions = Permission::all();
            return view("security_and_access.module_link.create", [
                'step' => $step,
                'module_id' => $module_id,
                'main_menu' => $main_menu,
                'subMenu' => $subMenu,
                'folder' => $folder,
                'existingController' => $existingController ?? '',
                'permissions' => $permissions
            ]);
        }

        if ($request->link_type == 4) {
            $modules = Module::where(['type' => '1'])->get();
            $step = 9;
            return view("security_and_access.module_link.create", [
                'step' => $step,
                'modules' => $modules
            ]);
        }

        if ($request->step == 9) {
            $module_id = $request->module_id;
            $step = 10;
            $folder = null;
            // without this check query injection occur in here.
            if ($module_id) {
                $existingController = ModuleLink::select('controller')->where('module_id', $module_id)->first();
                if ($existingController != null) {
                    $exController = ModuleLink::select('controller')->where('module_id', $module_id)->first()->controller;
                    $position = strpos($exController, '\\');
                    $folder = $position == false ? null : substr($exController, 0, $position);
                }
            }
            $permissions = Permission::all();
            return view("security_and_access.module_link.create", [
                'step' => $step,
                'module_id' => $module_id,
                'folder' => $folder,
                'existingController' => $existingController ?? '',
                'permissions' => $permissions
            ]);
        }

        $step = 1;
        return view("security_and_access.module_link.create", [
            'step' => $step,
        ]);
    }

    public function linkStore(Request $request)
    {
        $make_controller  = $request->controller;
        $make_model  = $request->model;
        $make_migration  = $request->migration;
        $make_seeder  = $request->seeder;
        $make_view  = $request->view;
        $module_id  = $request->module_id;
        $link_type  = $request->link_type;
        $main_menu_id  = $request->main_menu;
        $sub_menu_id  = $request->sub_menu;
        $module_id_for_other  = $request->module_id_for_other;
        $permission = $request->permission;
        $status = $request->status;
        $method  = $request->method;
        $method  = str_replace(" ", "", $method);
        $request_type  = $request->request_type;
        $folder  = $request->folder;
        $folder = str_replace(" ", "", $folder);
        $url = $request->url;
        $url  = Str::lower($url);
        $url  = str_replace(" ", "", $url);
        $positionOfSecondBreak = strpos($url, '{');
        if ($positionOfSecondBreak !== false) {
            $substrSecondBreak = substr($url, 0, $positionOfSecondBreak);
        } else {
            $substrSecondBreak = $url;
        }
        $replaceToDot = Str::replace('/', '.', $substrSecondBreak);
        if (substr($replaceToDot, -1) === '.') {
            $name = substr($replaceToDot, 0, -1);
        } else {
            $name = $replaceToDot;
        }

        if ($module_id) {
            $existingController = ModuleLink::select('controller')->where('module_id', $module_id)->first();
            if ($existingController != null) {
                $exController = ModuleLink::select('controller')->where('module_id', $module_id)->first()->controller;
                $position = strpos($exController, '\\');
                $folder = $position == false ? null : substr($exController, 0, $position);
            }
        }
        if ($module_id_for_other) {
            if ($module_id) {
                $name_for_all  = $request->name;
                if ($name_for_all) {
                    $name_of = str_replace(" ", "", $name_for_all);
                    $controller = $name_of . "Controller";
                    $model = $name_of;
                    $seeder = $name_of . "Seeder";
                    $spase_to_under = str_replace(" ", "_", $name_for_all);
                    $table_name_lower = Str::lower($spase_to_under);
                    $migration = "create_" . $table_name_lower . "s_table";
                    $view_name_lower = Str::lower($spase_to_under);
                    $view = $view_name_lower;
                } else {
                    $name_of_module = Module::select('name')->where('id', $module_id)->first()->name;
                    $module_name = str_replace(" ", "", $name_of_module);
                    $controller = $module_name . "Controller";
                    $model = $module_name;
                    $seeder = $module_name . "Seeder";
                    $spase_to_under = str_replace(" ", "_", $name_of_module);
                    $module_name_lower = Str::lower($spase_to_under);
                    $migration = "create_" . $module_name_lower . "s_table";
                    $view = $module_name_lower;
                }
            } else {
                $controller = $request->controller;
                $controller = str_replace(" ", "", $controller);

                $model = $request->model;
                $model = Str::title($model);
                $model = str_replace(" ", "", $model);

                $seeder = $request->seeder;
                $seeder = Str::title($seeder);
                $seeder = str_replace(" ", "", $seeder);

                $spase_to_under = str_replace(" ", "_", $request->migration);
                $migration_name_lower = Str::lower($spase_to_under);
                $migration = "create_" . $migration_name_lower;

                $spase_to_under_for_view = str_replace(" ", "_", $request->view);
                $view_name_lower = Str::lower($spase_to_under_for_view);
                $view = $view_name_lower;
            }
        } else if ($sub_menu_id) {
            $existing = ModuleLink::where(['link_type' => '3', 'sub_menu_id' => $sub_menu_id])->first();
            if ($existing) {
                return redirect()->to('module/link/index')->with("error", "Already define url : " . Str::replaceFirst('/', '', $existing->url) . ", controller : $existing->controller, method : $existing->method, request type : $existing->request_type and name : $existing->name for this sub menu. Please try another one.");
            }
            $sub_menu = Module::select('name')->where('id', $sub_menu_id)->first()->name;
            $toTitle = Str::title($sub_menu);
            $sub_menu_name = str_replace(" ", "", $toTitle);
            $controller = $sub_menu_name . "Controller";
            $model = $sub_menu_name;
            $seeder = $sub_menu_name . "Seeder";
            $spase_to_under = str_replace(" ", "_", $sub_menu);
            $sub_menu_name_lower = Str::lower($spase_to_under);
            $migration = "create_" . $sub_menu_name_lower . "s_table";
            $view = $sub_menu_name_lower;
        } else if ($main_menu_id) {
            $existing = ModuleLink::where(['link_type' => '2', 'main_menu_id' => $main_menu_id])->first();
            if ($existing) {
                return redirect()->to('module/link/index')->with("error", "Already define url : " . Str::replaceFirst('/', '', $existing->url) . ", controller : $existing->controller, method : $existing->method, request type : $existing->request_type and name : $existing->name for this main menu. Please try another one.");
            }
            $main_menu = Module::select('name')->where('id', $main_menu_id)->first()->name;
            $toTitle = Str::title($main_menu);
            $main_menu_name = str_replace(" ", "", $toTitle);
            $controller = $main_menu_name . "Controller";
            $model = $main_menu_name;
            $seeder = $main_menu_name . "Seeder";
            $spase_to_under = str_replace(" ", "_", $main_menu);
            $main_menu_name_lower = Str::lower($spase_to_under);
            $migration = "create_" . $main_menu_name_lower . "s_table";
            $view = $main_menu_name_lower;
        } else if ($module_id) {
            $existing = ModuleLink::where(['link_type' => '1', 'module_id' => $module_id])->first();
            if ($existing) {
                return redirect()->to('module/link/index')->with("error", "Already define url : " . Str::replaceFirst('/', '', $existing->url) . ", controller : $existing->controller, method : $existing->method, request type : $existing->request_type and name : $existing->name for this module. Please try another one.");
            }
            $name_of_module = Module::select('name')->where('id', $module_id)->first()->name;
            $toTitle = Str::title($name_of_module);
            $module_name = str_replace(" ", "", $toTitle);
            $controller = $module_name . "Controller";
            $model = $module_name;
            $seeder = $module_name . "Seeder";
            $spase_to_under = str_replace(" ", "_", $name_of_module);
            $module_name_lower = Str::lower($spase_to_under);
            $migration = "create_" . $module_name_lower . "s_table";
            $view = $module_name_lower;
        }

        $folderAndController = $folder . '\\' . $controller;
        $folderAndModel = $folder . '\\' . $model;
        $folderAndSeeder = $folder . '\\' . $seeder;
        $kebab = Str::snake($folder);
        $folderAndView = $kebab . '\\' . $view;
        $prefix = Str::lower($folder);
        try {
            if ($request_type == 'get_and_post') {
                $insert = ModuleLink::create([
                    'prefix' => '/' . $prefix,
                    'request_type' => 'get',
                    'url' => '/' . $url,
                    'controller' => $folderAndController,
                    'method' => $method,
                    'name' => $prefix . '.' . $name,
                    'link_type' => $link_type,
                    'module_id' => $module_id,
                    'main_menu_id' => $main_menu_id,
                    'sub_menu_id' => $sub_menu_id,
                    'permission' => $permission,
                    'active_status' => $status
                ]);
                $insert = ModuleLink::create([
                    'prefix' => '/' . $prefix,
                    'request_type' => 'post',
                    'url' => '/' . $url,
                    'controller' => $folderAndController,
                    'method' => $method,
                    'name' => $prefix . '.' . $name,
                    'link_type' => $link_type,
                    'module_id' => $module_id,
                    'main_menu_id' => $main_menu_id,
                    'permission' => $permission,
                    'sub_menu_id' => $sub_menu_id,
                    'active_status' => $status
                ]);
            } else {
                $insert = ModuleLink::create([
                    'prefix' => '/' . $prefix,
                    'request_type' => $request_type,
                    'url' => '/' . $url,
                    'controller' => $folderAndController,
                    'method' => $method,
                    'name' => $prefix . '.' . $name,
                    'link_type' => $link_type,
                    'module_id' => $module_id,
                    'main_menu_id' => $main_menu_id,
                    'permission' => $permission,
                    'sub_menu_id' => $sub_menu_id,
                    'active_status' => $status
                ]);
            }
            if ($insert) {
                $controller_path = app_path("Http/Controllers/{$folderAndController}.php");
                $model_path = app_path("Models/{$folderAndModel}.php");
                $seeder_path = database_path("seeders/{$folderAndSeeder}.php");
                $migration_path = database_path("migrations/{$migration}.php");
                $view_path = resource_path("views/{$folderAndView}.blade.php");

                if ($make_controller)
                    if (!File::exists($controller_path)) {
                        Artisan::call("make:controller " . $folder . "/" .  $controller);
                    }

                if ($make_model)
                    if (!File::exists($model_path)) {
                        Artisan::call("make:model " . $folder . "/" .  $model);
                    }

                if ($make_seeder)
                    if (!File::exists($seeder_path)) {
                        Artisan::call("make:seeder " . $seeder);
                    }

                if ($make_migration)
                    if (!File::exists($migration_path)) {
                        Artisan::call("make:migration " . $migration);
                    }

                if ($make_view)
                    if (!File::exists($view_path)) {
                        Artisan::call("make:view " . $kebab . "/" .  $view);
                    }

                Artisan::call("make:method "  . $folder . "/" . $controller . " $method");
                DB::commit();
                return redirect()->route('module-link-index')->with("success", "Module Link Create Successfully!");
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('module-link-index')->with("error", $e . " Something want wrong!, please try again");
        }
    }
}
