<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LineController;
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
    Route::get('/user-trashed', [UserController::class, 'trashed'])->name('user.trashed');
    Route::get('/user/restore/{id}', [UserController::class, 'restore'])->name('user.restore');
    Route::get('/user/force/delete/{id}', [UserController::class, 'forceDelete'])->name('user.force.delete');
    Route::get('/user/status/{id}', [UserController::class, 'status'])->name('user.status');

    Route::resource('role', RoleController::class);

    Route::resource('role-permission', RolePermissionController::class);

    Route::resource('department', DepartmentController::class);
    Route::resource('designation', DesignationController::class);

    Route::resource('line', LineController::class);
    Route::get('/line-trashed', [LineController::class, 'trashed'])->name('line.trashed');
    Route::get('/line/restore/{id}', [LineController::class, 'restore'])->name('line.restore');
    Route::get('/line/force/delete/{id}', [LineController::class, 'forceDelete'])->name('line.force.delete');
    Route::get('/line/status/{id}', [LineController::class, 'status'])->name('line.status');

});




