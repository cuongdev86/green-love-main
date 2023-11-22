<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminAudioController;
use App\Http\Controllers\Admin\AdminVideoController;

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

Route::get('/', [AdminDashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/login', [AdminDashboardController::class, 'login'])->name('dashboard');

Route::prefix('/admin')->group(function () {
    Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
        Route::get('/', [AdminCategoryController::class, 'index'])->name('index');
        Route::get('/create', [AdminCategoryController::class, 'create'])->name('create');
        Route::post('/store', [AdminCategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AdminCategoryController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [AdminCategoryController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [AdminCategoryController::class, 'destroy'])->name('destroy');
    });
    Route::group(['prefix' => 'posts', 'as' => 'posts.'], function () {
        Route::get('/', [AdminPostController::class, 'index'])->name('index');
        Route::get('/create', [AdminPostController::class, 'create'])->name('create');
        Route::post('/store', [AdminPostController::class, 'store'])->name('store');
        Route::get('/edit/{id}/{slug}', [AdminPostController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [AdminPostController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [AdminPostController::class, 'destroy'])->name('destroy');
    });
    Route::group(['prefix' => 'audios', 'as' => 'audios.'], function () {
        Route::get('/', [AdminAudioController::class, 'index'])->name('index');
        Route::get('/create', [AdminAudioController::class, 'create'])->name('create');
        Route::post('/store', [AdminAudioController::class, 'store'])->name('store');
        Route::get('/edit/{id}/{slug}', [AdminAudioController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [AdminAudioController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [AdminAudioController::class, 'destroy'])->name('destroy');
    });
    Route::group(['prefix' => 'videos', 'as' => 'videos.'], function () {
        Route::get('/', [AdminVideoController::class, 'index'])->name('index');
        Route::get('/create', [AdminVideoController::class, 'create'])->name('create');
        Route::post('/store', [AdminVideoController::class, 'store'])->name('store');
        Route::get('/edit/{id}/{slug}', [AdminVideoController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [AdminVideoController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [AdminVideoController::class, 'destroy'])->name('destroy');
    });
});
