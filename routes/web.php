<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\PetsController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Models\User;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['guest'])->get('/', [WelcomeController::class, 'show'])->name('welcome');

Route::middleware(['auth:sanctum', 'verified'])->group(function() {
    Route::prefix('user')->middleware(['role:'.User::ROLE_USER])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

        Route::prefix('pets')->name('pets.')->group(function() {
            Route::get('/', [PetsController::class, 'index'])->name('index');
            Route::post('/store', [PetsController::class, 'store'])->name('store');
            Route::put('/{pet}/update', [PetsController::class, 'update'])->name('update');
            Route::delete('/delete/{pet}', [PetsController::class, 'destroy'])->name('destroy');
        });
        Route::prefix('services')->name('services.')->group(function() {
            Route::get('/', [ServiceController::class, 'index'])->name('index');
            Route::post('/store', [ServiceController::class, 'store'])->name('store');
        });
    });
    Route::prefix('admin')->middleware(['role:'.User::ROLE_ADMIN])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/services', [AdminController::class, 'services'])->name('admin.services');
        Route::delete('/delete/{service}', [ServiceController::class, 'destroy'])->name('admin.destroy');
    });
});

