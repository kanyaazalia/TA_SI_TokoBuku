<?php

use App\Http\Controllers\BukuController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\PenulisController;
use App\Http\Controllers\TransaksiController;

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
Route::resource('/kategori', KategoriController::class)->middleware('admin');
Route::resource('/penerbit', PenerbitController::class)->middleware('auth');

Route::get('/penulis', [PenulisController::class, 'index'])->middleware('auth');
Route::get('/penulis/create', [PenulisController::class, 'create'])->middleware('auth');
Route::post('/penulis', [PenulisController::class, 'store'])->middleware('auth');
Route::get('/penulis/{penulis}', [PenulisController::class, 'show'])->middleware('auth');
Route::get('/penulis/{penulis}/edit', [PenulisController::class, 'edit'])->middleware('auth');
Route::put('/penulis/{penulis}', [PenulisController::class, 'update'])->middleware('auth');
Route::delete('/penulis/{penulis}', [PenulisController::class, 'destroy'])->middleware('auth');

// Rute melihat/menambahkan product ke counter
Route::get('/transaksi/{id_transaksi}/detail', [TransaksiController::class, 'detail'])->middleware('auth');
Route::post('/transaksi/{id_transaksi}/detail', [TransaksiController::class, 'detail'])->middleware('auth');
// Route::get('/transaksi/{id_transaksi}/invoice', [TransaksiController::class, 'invoice'])->middleware('auth');
// Route::post('/transaksi/{id_transaksi}/invoice', [TransaksiController::class, 'invoice'])->middleware('auth');
Route::post('/transaksi/{id_transaksi}/addbuku', [TransaksiController::class, 'addBuku'])->middleware('auth');
Route::post('/transaksi/{id_transaksi}/deletebuku', [TransaksiController::class, 'deleteBuku'])->middleware('auth');