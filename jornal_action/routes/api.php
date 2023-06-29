<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ActionController;
use App\Http\Controllers\AuthController;
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
Route::get('/generate-key-pair', 'KeyPairController@generateKeyPair');
Route::post('register', [AuthController::class, 'register'] );
Route::post('login', [AuthController::class, 'login'] );
Route::middleware('jwt.auth')->group(function () {
    Route::post('logout',  [AuthController::class, 'logout']);
    Route::get('user',  [AuthController::class, 'user']);
    Route::post('/log', [ActionController::class, 'store']);
    Route::get('/log', [ActionController::class, 'index']); 
    Route::post('/actions/filter', [ActionController::class, 'filter'])->name('actions.filter');
});