<?php

use App\Models\Module\ModuleLink;

$moduleLink = ModuleLink::where('active_status', 1)->get();
foreach ($moduleLink as $link) {
    $controller = "App\Http\Controllers\\$link->controller";
    $route = "Illuminate\Support\Facades\Route::$link->request_type";
    call_user_func($route, "/$link->url", [$controller, $link->method])->name($link->name);
}




// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Module\ModuleController;
// use App\Http\Controllers\Module\ModuleLinkController;
// use App\Http\Controllers\Module\HomeController;
// use App\Models\Module\ModuleLink;


// Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('module/index', [ModuleController::class, 'moduleIndex'])->name('module-index');
// Route::get('module/create', [ModuleController::class, 'moduleCreate'])->name('module-create');
// Route::post('module/store', [ModuleController::class, 'moduleStore'])->name('module-store');
// Route::get('module/edit/{id}', [ModuleController::class, 'moduleEdit'])->name('module-edit');
// Route::patch('module/update', [ModuleController::class, 'moduleUpdate'])->name('module-update');
// Route::put('module/Status', [ModuleController::class, 'moduleStatus'])->name('module-status');
// Route::delete('module/delete', [ModuleController::class, 'moduleDelete'])->name('module-delete');
// Route::get('module/path/{id}', [ModuleController::class, 'path'])->name('module-path');

// Route::get('menu/index', [ModuleController::class, 'menuIndex'])->name('menu-index');
// Route::get('menu/create', [ModuleController::class, 'menuCreate'])->name('menu-create');
// Route::post('menu/store', [ModuleController::class, 'menuStore'])->name('menu-store');

// Route::get('module/link/index', [ModuleLinkController::class, 'linkIndex'])->name('module-link-index');
// Route::get('module/link/create', [ModuleLinkController::class, 'linkCreate'])->name('module-link-create');
// Route::post('module/link/store', [ModuleLinkController::class, 'linkStore'])->name('module-link-store');




