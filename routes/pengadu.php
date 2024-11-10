<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\SopController;
use App\Http\Controllers\User\PengaduanController;
use App\Http\Controllers\User\StatistikController;
use App\Http\Middleware\PengaduMiddleware;

// Route Management Home Pada Pengadu
Route::get('/home', function () {
  return view('user.home');
})->name('home')->middleware('auth');

Route::get('/home', function () {
  return view('user.home');
})->name('sop.index')->middleware('auth');
Route::post('/home', [PengaduanController::class, 'home'])->name('pengaduan.home')->middleware('auth');
// Route Management Statistik Pada Pengadu
Route::get('/home', [StatistikController::class, 'index'])->name('home')->middleware('auth');

// Route Management SOP Pada Pengadu
Route::get('/home/sop', [SopController::class, 'show'])->name('sop.index')->middleware('auth');

// Route Management Pengaduan Pada Pengadu
Route::get('/pengaduan/{id}', [PengaduanController::class, 'show'])->name('pengaduan.show')->middleware('auth');
Route::patch('/home', [PengaduanController::class, 'create'])->name('pengaduan.form')->middleware('auth');
Route::put('/pengaduan/{id}', [PengaduanController::class, 'update'])->name('pengaduan.update')->middleware('auth');
Route::patch('/home', [PengaduanController::class, 'create'])->name('pengaduan.index')->middleware('auth');

Route::get('/detail', function () {
  return view('user.detail');
})->name('detail')->middleware('auth');