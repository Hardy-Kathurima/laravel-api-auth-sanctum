<?php

use App\Http\Controllers\BlogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/blogs', [BlogController::class,'index']);
Route::get('/blogs/{blog}',[BlogController::class,'show']);
Route::put('/blogs/{blog}',[BlogController::class,'update']);
Route::post('/blogs',[BlogController::class,'store']);
Route::delete('/blogs/{blog}',[BlogController::class,'destroy']);
