<?php

use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'v1'], function () {
    Route::prefix('blog-posts')->group(function () {
        Route::get('/', [\App\Http\Controllers\Backend\BlogPostController::class, 'blogPostsList']);
        Route::get('/{id}', [\App\Http\Controllers\Backend\BlogPostController::class, 'fetchPost']);
    });
});
