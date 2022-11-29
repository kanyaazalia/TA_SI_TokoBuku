<?php

use App\Http\Controllers\BukuController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\PenulisController;

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

Route::get('/', [LoginController::class, 'index'])->middleware('guest');
// Memberikan nama 'login' ke rute login agar user yang belum login dapat diarahkan ke rute ini
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');
// Rute untuk logout
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::get('/home', [HomeController::class, 'index'])->middleware('auth');
Route::resource('/karyawan', KaryawanController::class)->middleware('admin');
Route::resource('/buku', BukuController::class)->middleware('auth');
Route::resource('/buku/kategori', KategoriController::class)->middleware('admin');
Route::resource('/buku/penulis', PenulisController::class)->middleware('user');
Route::resource('/buku/penerbit', PenerbitController::class)->middleware('user');
