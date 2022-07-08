<?php

use App\Http\Controllers\AuthController;
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


// authentication routes

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout']);

Route::get('/blogs', [BlogController::class,'index']);
Route::get('/blogs/{blog}',[BlogController::class,'show']);



// protected routes

Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::put('/blogs/{blog}',[BlogController::class,'update']);
    Route::post('/blogs',[BlogController::class,'store']);
    Route::delete('/blogs/{blog}',[BlogController::class,'destroy']);
});



