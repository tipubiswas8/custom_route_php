<?php

use Illuminate\Support\Facades\Route;
use App\Models\SecurityAndAccess\ModuleLink;


// $moduleLinks = ModuleLink::where('active_status', 1)->get();
// foreach ($moduleLinks as $link) {
//     Route::prefix("$link->prefix")->group(function () use ($link) {
//         $controller = "App\Http\Controllers\\{$link->controller}";
//         $routeType = strtolower($link->request_type);
//         if (in_array($routeType, ['get', 'post', 'put', 'delete', 'patch'])) {
//             Route::$routeType("/{$link->url}", [$controller, $link->method])->name($link->name);
//         }
//     });
// }


$moduleLink = ModuleLink::where('active_status', 1)->get();
foreach ($moduleLink as $link) {
    Route::prefix($link->prefix)->group(function () use ($link) {
    $controller = "App\Http\Controllers\\$link->controller";
    $route = "Illuminate\Support\Facades\Route::$link->request_type";
    call_user_func($route, "/$link->url", [$controller, $link->method])->name($link->name);
    });
}



// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\SecurityAndAccess\HomeController;
// use App\Http\Controllers\SecurityAndAccess\SecurityAndAccessController;
// use App\Http\Controllers\SecurityAndAccess\ModuleController;
// use App\Http\Controllers\SecurityAndAccess\ModuleLinkController;

// Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::prefix('securityandaccess')->group(function () {
// Route::get('security/access/index', [SecurityAndAccessController::class, 'index'])->name('security-access-index');
// Route::get('module/search', [ModuleController::class, 'moduleSearch'])->name('module-search');
// Route::get('module/create', [ModuleController::class, 'moduleCreate'])->name('module-create');
// Route::post('module/store', [ModuleController::class, 'moduleStore'])->name('module-store');
// Route::get('module/edit/{id}', [ModuleController::class, 'moduleEdit'])->name('module-edit');
// Route::patch('module/update', [ModuleController::class, 'moduleUpdate'])->name('module-update');
// Route::put('module/status', [ModuleController::class, 'moduleStatus'])->name('module-status');
// Route::delete('module/delete', [ModuleController::class, 'moduleDelete'])->name('module-delete');

// Route::get('menu/index', [ModuleController::class, 'menuIndex'])->name('menu-index');
// Route::get('menu/create', [ModuleController::class, 'menuCreate'])->name('menu-create');
// Route::post('menu/store', [ModuleController::class, 'menuStore'])->name('menu-store');

// Route::get('module/link/index', [ModuleLinkController::class, 'linkIndex'])->name('module-link-index');
// Route::get('module/link/create', [ModuleLinkController::class, 'linkCreate'])->name('module-link-create');
// Route::post('module/link/store', [ModuleLinkController::class, 'linkStore'])->name('module-link-store');
// });



