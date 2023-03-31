<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BrgMskController;
use App\Http\Controllers\BrgKeluarController;
use App\Http\Controllers\LaporanController;

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



Route::get('/', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => 'auth'], function () {
    // User needs to be authenticated to enter here.
    Route::get('/home', function () {
        return view('home');
    });

    // Master User
    Route::get('/user', [UserController::class, 'index']);
    Route::post('/user/store', [UserController::class, 'store']);
    Route::post('/user/{id}/update', [UserController::class, 'update']);
    Route::get('/user/{id}/destroy', [UserController::class, 'destroy']);

    Route::get('/kategori', [KategoriController::class, 'index']);
    Route::post('/kategori/store', [KategoriController::class, 'store']);
    Route::post('/kategori/{id}/update', [KategoriController::class, 'update']);
    Route::get('/kategori/{id}/destroy', [KategoriController::class, 'destroy']);

    Route::get('/barang', [BarangController::class, 'index']);
    Route::post('/barang/store', [BarangController::class, 'store']);
    Route::post('/barang/{id}/update', [BarangController::class, 'update']);
    Route::get('/barang/{id}/destroy', [BarangController::class, 'destroy']);

    Route::get('/barang_masuk', [BrgMskController::class, 'index']);
    Route::get('/barang_masuk/ajax', [BrgMskController::class, 'ajax']);
    Route::get('/barang_masuk/create', [BrgMskController::class, 'create']);
    Route::post('/barang_masuk/store', [BrgMskController::class, 'store']);

    Route::get('/barang_keluar', [BrgKeluarController::class, 'index']);
    Route::get('/barang_keluar/ajax', [BrgKeluarController::class, 'ajax']);
    Route::get('/barang_keluar/create', [BrgKeluarController::class, 'create']);
    Route::post('/barang_keluar/store', [BrgKeluarController::class, 'store']);

    Route::get('/lap_brg_masuk', [LaporanController::class, 'lap_brg_masuk']);
    Route::get('/lap_brg_masuk/cetak', [LaporanController::class, 'cetak_brg_masuk']);

    Route::get('/lap_brg_keluar', [LaporanController::class, 'lap_brg_keluar']);
    Route::get('/lap_brg_keluar/cetak', [LaporanController::class, 'cetak_brg_keluar']);

    Route::get('/lap_user', [LaporanController::class, 'lap_user']);
    Route::get('/lap_user/cetak', [LaporanController::class, 'cetak_user']);

    Route::get('/lap_barang', [LaporanController::class, 'lap_barang']);
    Route::get('/lap_barang/cetak', [LaporanController::class, 'cetak_barang']);
});