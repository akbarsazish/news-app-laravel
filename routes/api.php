<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;


// Route::post('/sanctum/csrf-cookie', [LoginController::class, 'csrfCookie']);

// Route::post('/login', [LoginController::class, 'login'])->middleware('web');

// // Route::post('/login', [LoginController::class, 'login']);
// Route::post('/logout', [LoginController::class, 'logout']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/login', [LoginController::class, 'loginUser']);
Route::post('/register', [LoginController::class, 'register']);


Route::group(['middleware' => 'auth:sanctum'], function () {
 Route::get('user', [LoginController::class, 'userDetails']);
 Route::post('logout', [LoginController::class, 'logout']);
});
