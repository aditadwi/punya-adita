<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KudapanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CetakController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\WelcomeController;
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

Route::get('/', function () {     
    return view('welcome',[ 
    "title"=>"Dashboard" 
]);
});

Route::resource('pelanggan',PelangganController::class)
->except('destory')->middleware('auth');
Route::resource('kudapan',KudapanController::class)->middleware('auth');
Route::resource('user',UserController::class)
->except('destroy','create','show','update','edit')->middleware('auth');
Route::get('login',[LoginController::class,'loginView'])->name('login');
Route::post('login',[LoginController::class,'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');
Route::get('penjualan',function(){return View('penjualan.index',[
    "title"=>"Penjualan"
]);
})->name('penjualan')->middleware('auth');

Route::get('transaksi',function(){return View('penjualan.transaksis',[
    "title"=>"Transaksi"
]);
});
Route::get('/',[WelcomeController::class,'welcome'])->middleware('auth');


Route::get('cetakReceipt',[CetakController::class,'receipt'])->name('cetakReceipt')->middleware('auth');

Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
