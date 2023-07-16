<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BuyerController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\SeasonController;
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
    Route::resource('color', ColorController::class);
    Route::resource('wash', WashController::class);
    Route::resource('season', SeasonController::class);

});




