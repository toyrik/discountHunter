<?php

use Illuminate\Support\Facades\Auth;
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
    return redirect('home');
});

Auth::routes();
Route::group(['middlevare' => 'auth', 'namespace' => 'App\Http\Controolers'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/get-discount', [App\Http\Controllers\HomeController::class, 'discount'])->name('discount');
    Route::post('/check-discount', [App\Http\Controllers\HomeController::class, 'checkDiscount'])->name('check-discount');
});
