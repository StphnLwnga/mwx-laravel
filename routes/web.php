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

Route::get('/', function () {
	return view('welcome');
});

Route::get('/process-payment', function () {
	return view('test', ['description' => 'Process values received from iPay and register user']);
});

Route::get('/preprocess', function () {
	return view('test', ['description' => 'Process payment before sending to iPay']);
});
