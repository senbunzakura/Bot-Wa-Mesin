<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Dashboard
Route::get('/', [App\Http\Controllers\DashboardController::class, 'index']);

// Akun
Route::get('/akun', [App\Http\Controllers\AkunController::class, 'index']);
Route::get('/akun/create', [App\Http\Controllers\AkunController::class, 'create']);
Route::post('/akun/store', [App\Http\Controllers\AkunController::class, 'store']);
Route::get('/akun/edit/{id}', [App\Http\Controllers\AkunController::class, 'edit']);
Route::patch('/akun/update/{id}', [App\Http\Controllers\AkunController::class, 'update']);
Route::delete('/akun/delete/{id}', [App\Http\Controllers\AkunController::class, 'delete']);


// Mesin
Route::get('/mesin', [App\Http\Controllers\MesinController::class, 'index']);
Route::get('/mesin/create', [App\Http\Controllers\MesinController::class, 'create']);
Route::post('/mesin/store', [App\Http\Controllers\MesinController::class, 'store']);
Route::get('/mesin/edit/{id}', [App\Http\Controllers\MesinController::class, 'edit']);
Route::patch('/mesin/update/{id}', [App\Http\Controllers\MesinController::class, 'update']);
Route::delete('/mesin/delete/{id}', [App\Http\Controllers\MesinController::class, 'delete']);

// Perawatan
Route::get('/perawatan', [App\Http\Controllers\PerawatanController::class, 'index']);
Route::get('/perawatan/create', [App\Http\Controllers\PerawatanController::class, 'create']);
Route::post('/perawatan/store', [App\Http\Controllers\PerawatanController::class, 'store']);
Route::get('/perawatan/edit/{id}', [App\Http\Controllers\PerawatanController::class, 'edit']);
Route::patch('/perawatan/update/{id}', [App\Http\Controllers\PerawatanController::class, 'update']);
Route::delete('/perawatan/delete/{id}', [App\Http\Controllers\PerawatanController::class, 'delete']);

// Perbaikan
Route::get('/perbaikan', [App\Http\Controllers\PerbaikanController::class, 'index']);
Route::get('/perbaikan/create', [App\Http\Controllers\PerbaikanController::class, 'create']);
Route::post('/perbaikan/store', [App\Http\Controllers\PerbaikanController::class, 'store']);
Route::get('/perbaikan/edit/{id}', [App\Http\Controllers\PerbaikanController::class, 'edit']);
Route::patch('/perbaikan/update/{id}', [App\Http\Controllers\PerbaikanController::class, 'update']);
Route::delete('/perbaikan/delete/{id}', [App\Http\Controllers\PerbaikanController::class, 'delete']);

Route::post('/fonnte/webhook',  [App\Http\Controllers\FoonteWebhookController::class, 'receive']);