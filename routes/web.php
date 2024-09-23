<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::prefix('blogs')->group(function () {
        Route::get('/', [\App\Http\Controllers\Frontend\BlogsController::class, 'index'])->name('blogs.list');
        Route::get('/create', [\App\Http\Controllers\Frontend\BlogsController::class, 'create'])->name('blogs.create');
        Route::post('', [\App\Http\Controllers\Frontend\BlogsController::class, 'store'])->name('blogs.store');
    });
});
