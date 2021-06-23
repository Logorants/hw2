<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ServicesController;
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

/* LOGIN */
Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'auth']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

/* REGISTRAZIONE */
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

/* HOME */
Route::get('/home', [HomeController::class, 'index'])->name('home');

/* SERVIZI */
Route::get('/servizi', [ServicesController::class, 'index'])->name('servizi');
Route::get('/servizi/products/check/{itemid}', [ServicesController::class, 'prodcheck']);
Route::get('/servizi/search/{q}', [ServicesController::class, 'search']);
Route::get('/servizi/follows/load', [ServicesController::class, 'load']);
Route::post('/servizi/follows/add', [ServicesController::class, 'add']);
Route::get('/servizi/follows/check/{itemid}', [ServicesController::class, 'check']);
Route::post('/servizi/follows/delete', [ServicesController::class, 'delete']);

/* PARTNER */
Route::get('/partner', [PartnerController::class, 'index'])->name('partner');
Route::get('/partner/details', [PartnerController::class, 'search_details']);
Route::get('/partner/news', [PartnerController::class, 'search_news']);




