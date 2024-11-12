<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\SopController;
use App\Http\Controllers\User\PengaduanController;
use App\Http\Controllers\User\StatistikController;
use App\Http\Controllers\User\PengaduProfileController;

<<<<<<< HEAD
Route::middleware('is_Enduser')->group(function () {
  // Route Management Home Pada Pengadu
  Route::get('/home/{id}', function () {
    return view('user.home');
  })->name('home');
  
  Route::get('/home/{id}', function () {
    return view('user.home');
  })->name('sop.index');
  Route::post('/home', [PengaduanController::class, 'home'])->name('pengaduan.home');
  // Route Management Statistik Pada Pengadu
  Route::get('/home', [StatistikController::class, 'index'])->name('home');
  
  // Route Management SOP Pada Pengadu
  Route::get('/home/sop', [SopController::class, 'show'])->name('sop.index');
  
  // Route Management Pengaduan Pada Pengadu
  Route::get('/pengaduan/{id}', [PengaduanController::class, 'show'])->name('pengaduan.show');
  Route::patch('/home', [PengaduanController::class, 'create'])->name('pengaduan.form');
  Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
  Route::post('/pengaduan/batalkan', [PengaduanController::class, 'batalkan'])->name('pengaduan.batalkan');
  Route::put('/pengaduan/{id}', [PengaduanController::class, 'update'])->name('pengaduan.update');
  Route::patch('/home', [PengaduanController::class, 'create'])->name('pengaduan.index');
  
  Route::get('/detail', function () {
    return view('user.detail');
  })->name('detail');
  
  Route::get('/profile-pengadu', [PengaduProfileController::class, 'index'])->name('user.profile');
  Route::put('/profile-pengadu/{id}', [PengaduProfileController::class, 'update'])->name('user.profile.update');
});
=======
// Route Management Home Pada Pengadu
Route::get('/home/{id}', function () {
  return view('user.home');
})->name('home')->middleware('is_EndUser');

Route::get('/home/{id}', function () {
  return view('user.home');
})->name('sop.index')->middleware('is_Enduser');
Route::post('/home', [PengaduanController::class, 'home'])->name('pengaduan.home')->middleware('is_Enduser');
// Route Management Statistik Pada Pengadu
Route::get('/home', [StatistikController::class, 'index'])->name('home')->middleware('is_Enduser');

// Route Management SOP Pada Pengadu
Route::get('/home/sop', [SopController::class, 'show'])->name('sop.index')->middleware('is_Enduser');

// Route Management Pengaduan Pada Pengadu
Route::get('/pengaduan/{id}', [PengaduanController::class, 'show'])->name('pengaduan.show')->middleware('is_Enduser');
Route::patch('/home', [PengaduanController::class, 'create'])->name('pengaduan.form')->middleware('is_Enduser');
Route::put('/pengaduan/{id}/update', [PengaduanController::class, 'update'])->name('pengaduan.update')->middleware('is_Enduser');
Route::patch('/home', [PengaduanController::class, 'create'])->name('pengaduan.index')->middleware('is_Enduser');
Route::patch('/pengaduan/{id}/batalkan', [PengaduanController::class, 'batalkan'])->name('pengaduan.batalkan');
Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
Route::get('/detail', function () {
  return view('user.detail');
})->name('detail')->middleware('is_Enduser');

Route::get('/profile-pengadu', [PengaduProfileController::class, 'index'])->name('user.profile')->middleware('is_Enduser');
Route::put('/profile-pengadu/{id}', [PengaduProfileController::class, 'update'])->name('user.profile.update')->middleware('is_Enduser');
>>>>>>> feature/bug
