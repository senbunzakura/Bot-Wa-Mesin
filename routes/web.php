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
Route::get('/akun', [App\Http\Controllers\AkunController::class, 'index'])->name('akun.index');
Route::get('/akun/create', [App\Http\Controllers\AkunController::class, 'create'])->name('akun.create');
Route::post('/akun/store', [App\Http\Controllers\AkunController::class, 'store'])->name('akun.store');
Route::get('/akun/edit/{id}', [App\Http\Controllers\AkunController::class, 'edit'])->name('akun.edit');
Route::patch('/akun/update/{id}', [App\Http\Controllers\AkunController::class, 'update'])->name('akun.update');
Route::delete('/akun/delete/{id}', [App\Http\Controllers\AkunController::class, 'delete'])->name('akun.delete');

// Mesin
Route::get('/mesin', [App\Http\Controllers\MesinController::class, 'index'])->name('mesin.index');
Route::get('/mesin/create', [App\Http\Controllers\MesinController::class, 'create'])->name('mesin.create');
Route::post('/mesin/store', [App\Http\Controllers\MesinController::class, 'store'])->name('mesin.store');
Route::get('/mesin/edit/{id}', [App\Http\Controllers\MesinController::class, 'edit'])->name('mesin.edit');
Route::patch('/mesin/update/{id}', [App\Http\Controllers\MesinController::class, 'update'])->name('mesin.update');
Route::delete('/mesin/delete/{id}', [App\Http\Controllers\MesinController::class, 'delete'])->name('mesin.delete');

// Perawatan
Route::get('/perawatan', [App\Http\Controllers\PerawatanController::class, 'index'])->name('perawatan.index');
Route::get('/perawatan/create', [App\Http\Controllers\PerawatanController::class, 'create'])->name('perawatan.create');
Route::post('/perawatan/store', [App\Http\Controllers\PerawatanController::class, 'store'])->name('perawatan.store');
Route::get('/perawatan/edit/{id}', [App\Http\Controllers\PerawatanController::class, 'edit'])->name('perawatan.edit');
Route::patch('/perawatan/update/{id}', [App\Http\Controllers\PerawatanController::class, 'update'])->name('perawatan.update');
Route::delete('/perawatan/delete/{id}', [App\Http\Controllers\PerawatanController::class, 'delete'])->name('perawatan.delete');


// Laporan Kerusakan
Route::get('/laporan-kerusakan', [App\Http\Controllers\LaporanKerusakanController::class, 'index'])->name('kerusakan.index');


// Perbaikan
Route::get('/perbaikan', [App\Http\Controllers\PerbaikanController::class, 'index'])->name('perbaikan.index');
Route::get('/perbaikan/create', [App\Http\Controllers\PerbaikanController::class, 'create'])->name('perbaikan.create');
Route::post('/perbaikan/store', [App\Http\Controllers\PerbaikanController::class, 'store'])->name('perbaikan.store');
Route::get('/perbaikan/edit/{id}', [App\Http\Controllers\PerbaikanController::class, 'edit'])->name('perbaikan.edit');
Route::patch('/perbaikan/update/{id}', [App\Http\Controllers\PerbaikanController::class, 'update'])->name('perbaikan.update');
Route::delete('/perbaikan/delete/{id}', [App\Http\Controllers\PerbaikanController::class, 'delete'])->name('perbaikan.delete');
