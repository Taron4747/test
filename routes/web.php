<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\ProxyController;
use App\Http\Controllers\UserAgentsController;
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




Route::get('/', [CustomAuthController::class, 'dashboard']); 
Route::get('dashboard', [CustomAuthController::class, 'dashboard']); 
Route::get('login', [CustomAuthController::class, 'index']);
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('logout', [CustomAuthController::class, 'signOut'])->name('logout');
Route::get('/proxy', [App\Http\Controllers\ProxyController::class, 'getProxy']);
Route::post('/proxy-data', [App\Http\Controllers\ProxyController::class, 'getProxyData']);
Route::post('/add-proxy', [App\Http\Controllers\ProxyController::class, 'addProxy']);
Route::get('/get-proxy/{id}', [App\Http\Controllers\ProxyController::class, 'getProxyById']);
Route::post('/remove-proxy', [App\Http\Controllers\ProxyController::class, 'removeProxy']);
Route::get('/user-agents', [App\Http\Controllers\UserAgentsController::class, 'index']);
Route::post('/add-user-agent', [App\Http\Controllers\UserAgentsController::class, 'addUserAgent']);


