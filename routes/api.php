<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrameController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('create-category', [CategoryController::class, 'CreateCategory']);
Route::get('view-all-categories', [CategoryController::class, 'ViewAllCateogires']);

Route::post('create-frames', [FrameController::class, 'CreateFrames']);
Route::get('view-all-frames', [FrameController::class, 'ViewAllFrames']);
Route::get('view-frame/cat/{category_id}', [FrameController::class, 'ViewFramesByCategory']);



