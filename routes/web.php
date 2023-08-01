<?php

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([
    'prefix' => 'auth',
    'as' => 'auth.',
], function () {
    Route::get('', [App\Http\Controllers\AuthController::class, 'create'])->name('create');
    Route::post('store', [App\Http\Controllers\AuthController::class, 'store'])->name('store');
    Route::get('logout', [App\Http\Controllers\AuthController::class, 'destroy'])->name('destroy');
});

Route::group([
    'prefix' => 'user',
    'as' => 'user.',
], function () {
    Route::post('store', [App\Http\Controllers\UserController::class, 'store'])->name('store');
});

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => 'auth',
], function () {
    Route::get('', function () {
        return redirect()->route('admin.profession.index');
    })->name('index');
    Route::resource('profession', App\Http\Controllers\Admin\ProfessionController::class)->except(['view']);
    Route::resource('profession_category', App\Http\Controllers\Admin\ProfessionCategoryController::class)->except(['view']);
    Route::post('profession_category/select-search', [\App\Http\Controllers\Admin\ProfessionCategoryController::class, 'selectSearch'])
        ->name('profession_category.select_search');
    Route::resource('tag', App\Http\Controllers\Admin\TagController::class)->except(['view']);
    Route::post('tag/select-search', [\App\Http\Controllers\Admin\TagController::class, 'selectSearch'])->name('tag.select_search');
    Route::resource('work_day', \App\Http\Controllers\Admin\WorkDayController::class)->except(['view']);
    Route::resource('task', \App\Http\Controllers\Admin\TaskController::class)->except(['view']);
});

Route::middleware('auth')->resource('attachment', \App\Http\Controllers\AttachmentController::class)->only(['store']);
