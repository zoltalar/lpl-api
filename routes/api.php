<?php

// Misc
use Illuminate\Support\Facades\Route;

// Admin
use App\Http\Controllers\Admin\CategoryController as ApiAdminCategoryController;
use App\Http\Controllers\Admin\ListController as ApiAdminListController;
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
    
    // Categories
    Route::prefix('categories')->group(function () {
        Route::get('index', [ApiAdminCategoryController::class, 'index'])->name('api.admin.categories.index');
        Route::post('store', [ApiAdminCategoryController::class, 'store'])->name('api.admin.categories.store');
    });
    
    // Lists
    Route::prefix('lists')->group(function () {
        Route::get('index', [ApiAdminListController::class, 'index'])->name('api.admin.lists.index');
        Route::post('store', [ApiAdminListController::class, 'store'])->name('api.admin.lists.store');
        Route::match(['PUT', 'PATCH'], 'update/{list}', [ApiAdminListController::class, 'update'])->name('api.admin.lists.update');
        Route::delete('destroy/{list}', [ApiAdminListController::class, 'destroy'])->name('api.admin.lists.destroy');
    });
    
    // Users
    Route::prefix('users')->group(function () {
        Route::get('index', [ApiAdminUserController::class, 'index'])->name('api.admin.users.index');
        Route::post('store', [ApiAdminUserController::class, 'store'])->name('api.admin.users.store');
        Route::delete('destroy/{user}', [ApiAdminUserController::class, 'destroy'])->name('api.admin.users.destroy');
    });
    
});
