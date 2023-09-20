<?php

// Misc
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Admin
use App\Http\Controllers\Admin\UserController as ApiAdminUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('admin')->group(function () {
    
    // Users
    Route::prefix('users')->group(function () {
        Route::get('index', [ApiAdminUserController::class, 'index'])->name('api.admin.users.index');
        Route::post('store', [ApiAdminUserController::class, 'store'])->name('api.admin.users.store');
    });
    
});
