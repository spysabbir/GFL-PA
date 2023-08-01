<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/default/setting', [SettingController::class, 'defaultSetting'])->name('default.setting');
    Route::post('/default/setting/update/{id}', [SettingController::class, 'defaultSettingUpdate'])->name('default.setting.update');

    Route::resource('user', UserController::class);

    Route::resource('role', RoleController::class);

    Route::resource('role-permission', RolePermissionController::class);

    Route::resource('department', DepartmentController::class);
    Route::resource('designation', DesignationController::class);


});




