<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PengaduanController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\SopController;
use Illuminate\Support\Facades\Route;

// Route Management Dashboard Pada Admin
Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');


// Route Management Users Pada Admin
Route::get('/users', [UsersController::class, 'showUser'])->name('admin.user');

// Route Management Pengaduan Pada Admin
Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('admin.pengaduan');
Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
Route::get('/pengaduan/{id}/tindak-lanjut', [PengaduanController::class, 'showTindakLanjut'])->name('admin.pengaduan.tindak-lanjut');
Route::put('/pengaduan/{id}', [PengaduanController::class, 'update'])->name('admin.pengaduan.update');
Route::post('/home', [PengaduanController::class, 'home'])->name('pengaduan.home');
Route::patch('/pengaduan/{id}/batalkan', [PengaduanController::class, 'batalkan'])->name('pengaduan.batalkan');

// Route Management SOP Pada Admin
Route::get('/sop', [SopController::class, 'index'])->name('admin.sop.index');
Route::post('/sop', [SopController::class, 'store'])->name('admin.sop.store');
Route::get('/sop/{id}/edit', [SopController::class, 'edit'])->name('admin.sop.edit');
Route::put('/sop/{id}', [SopController::class, 'update'])->name('admin.sop.update');
Route::delete('/sop/{id}', [SopController::class, 'destroy'])->name('admin.sop.destroy');


// Route Management Kontak Pada Admin
Route::get('/kontak', [ContactController::class, 'index'])->name('contacts.index');
Route::post('/kontak', [ContactController::class, 'update'])->name('contacts.update');
Route::get('/user.footer', [ContactController::class, 'index'])->name('contacts.index');