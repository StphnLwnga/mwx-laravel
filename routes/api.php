<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductMetaController;
use App\Http\Controllers\MoworxAuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
use Illuminate\Http\Request;
use App\Http\Controllers\API\
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// }

Route::get('info', [ProductMetaController::class, 'index']);

Route::post('signin', [MoworxAuthController::class, 'signin']);

// Route::post('users', [MoworxAuthController::class, 'retrieveUsers']);

// Route::group(['prefix' => 'users', 'middleware' => 'CORS'], function ($router) {

//     Route::post('/register', [UserController::class, 'register'])->name('register.user');

//     Route::post('/login', [UserController::class, 'login'])->name('login.user');

//     Route::get('/view-profile', [UserController::class, 'viewProfile'])->name('profile.user');

//     Route::get('/logout', [UserController::class, 'logout'])->name('logout.user');
    
// });
