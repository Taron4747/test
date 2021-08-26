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
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
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

Route::get('/links', [App\Http\Controllers\LinksController::class, 'getLink']);
Route::post('/link-data', [App\Http\Controllers\LinksController::class, 'getLinkData']);
Route::post('/add-link', [App\Http\Controllers\LinksController::class, 'addLink']);
Route::get('/get-link/{id}', [App\Http\Controllers\LinksController::class, 'getLinkById']);
Route::post('/remove-link', [App\Http\Controllers\LinksController::class, 'removeLink']);

Route::get('/mails', [App\Http\Controllers\MailsController::class, 'getMail']);
Route::post('/mail-data', [App\Http\Controllers\MailsController::class, 'getMailData']);
Route::post('/add-mail', [App\Http\Controllers\MailsController::class, 'addMail']);
Route::get('/get-mail/{id}', [App\Http\Controllers\MailsController::class, 'getMailById']);
Route::post('/remove-mail', [App\Http\Controllers\MailsController::class, 'removeMail']);


