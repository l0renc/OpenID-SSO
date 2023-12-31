<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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



Route::get('/', [AuthController::class, 'redirectToProvider'])->name('login');
Route::get('/callback', [AuthController::class, 'handleProviderCallback']);
Route::get('/home', [AuthController::class, 'home'])->name('home');


