<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BuyerController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\MasterStyleController;
use App\Http\Controllers\Admin\SeasonController;
use App\Http\Controllers\Admin\StyleController;
use App\Http\Controllers\Admin\WashController;
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

    Route::resource('buyer', BuyerController::class);
    Route::get('/buyer-trashed', [BuyerController::class, 'trashed'])->name('buyer.trashed');
    Route::get('/buyer/restore/{id}', [BuyerController::class, 'restore'])->name('buyer.restore');
    Route::get('/buyer/force/delete/{id}', [BuyerController::class, 'forceDelete'])->name('buyer.force.delete');
    Route::get('/buyer/status/{id}', [BuyerController::class, 'status'])->name('buyer.status');

    Route::resource('color', ColorController::class);
    Route::get('/color-trashed', [ColorController::class, 'trashed'])->name('color.trashed');
    Route::get('/color/restore/{id}', [ColorController::class, 'restore'])->name('color.restore');
    Route::get('/color/force/delete/{id}', [ColorController::class, 'forceDelete'])->name('color.force.delete');
    Route::get('/color/status/{id}', [ColorController::class, 'status'])->name('color.status');

    Route::resource('wash', WashController::class);
    Route::get('/wash-trashed', [WashController::class, 'trashed'])->name('wash.trashed');
    Route::get('/wash/restore/{id}', [WashController::class, 'restore'])->name('wash.restore');
    Route::get('/wash/force/delete/{id}', [WashController::class, 'forceDelete'])->name('wash.force.delete');
    Route::get('/wash/status/{id}', [WashController::class, 'status'])->name('wash.status');

    Route::resource('season', SeasonController::class);
    Route::get('/season-trashed', [SeasonController::class, 'trashed'])->name('season.trashed');
    Route::get('/season/restore/{id}', [SeasonController::class, 'restore'])->name('season.restore');
    Route::get('/season/force/delete/{id}', [SeasonController::class, 'forceDelete'])->name('season.force.delete');
    Route::get('/season/status/{id}', [SeasonController::class, 'status'])->name('season.status');

    Route::resource('style', StyleController::class);
    Route::get('/style-trashed', [StyleController::class, 'trashed'])->name('style.trashed');
    Route::get('/style/restore/{id}', [StyleController::class, 'restore'])->name('style.restore');
    Route::get('/style/force/delete/{id}', [StyleController::class, 'forceDelete'])->name('style.force.delete');
    Route::get('/style/status/{id}', [StyleController::class, 'status'])->name('style.status');

    Route::resource('master-style', MasterStyleController::class);
    Route::get('/master-style-trashed', [MasterStyleController::class, 'trashed'])->name('master-style.trashed');
    Route::get('/master-style/restore/{id}', [MasterStyleController::class, 'restore'])->name('master-style.restore');
    Route::get('/master-style/force/delete/{id}', [MasterStyleController::class, 'forceDelete'])->name('master-style.force.delete');
    Route::get('/master-style/status/{id}', [MasterStyleController::class, 'status'])->name('master-style.status');


});




