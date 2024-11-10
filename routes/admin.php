<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PelaporanController;
use App\Http\Controllers\Admin\PengaduanController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\SopController;
use Illuminate\Support\Facades\Route;

// Route Management Dashboard Pada Admin
Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('is_admin')    ;


// Route Management Users Pada Admin
Route::get('/users', [UsersController::class, 'showUser'])->name('admin.user')->middleware('auth');
Route::get('/users/{id}/edit', [UsersController::class, 'edit'])->name('admin.users.edit')->middleware('auth');
Route::put('/users/{id}', [UsersController::class, 'update'])->name('admin.users.update')->middleware('auth');
Route::delete('/users/{id}', [UsersController::class, 'destroy'])->name('admin.users.destroy')->middleware('auth');

// Route Management Pengaduan Pada Admin
Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('admin.pengaduan')->middleware('auth');
Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store')->middleware('auth');
Route::get('/pengaduan/{id}/tindak-lanjut', [PengaduanController::class, 'showTindakLanjut'])->name('admin.pengaduan.tindak-lanjut')->middleware('auth');
Route::put('/pengaduan/{id}', [PengaduanController::class, 'update'])->name('admin.pengaduan.update')->middleware('auth');

Route::patch('/pengaduan/{id}/batalkan', [PengaduanController::class, 'batalkan'])->name('pengaduan.batalkan')->middleware('auth');
Route::get('/pengaduan/{id}/download', [PengaduanController::class, 'download'])->name('pengaduan.download')->middleware('auth');

// Route Management Pelaporan Pada Admin
Route::get('/pelaporan', [PelaporanController::class, 'index'])->name('pelaporan');

// Route Management Statistik Pengaduan Pada Admin


// Route Management SOP Pada Admin
Route::get('/sop', [SopController::class, 'index'])->name('admin.sop.index')->middleware('auth');
Route::post('/sop', [SopController::class, 'store'])->name('admin.sop.store')->middleware('auth');
Route::get('/sop/{id}/edit', [SopController::class, 'edit'])->name('admin.sop.edit')->middleware('auth');
Route::put('/sop/{id}', [SopController::class, 'update'])->name('admin.sop.update')->middleware('auth');
Route::delete('/sop/{id}', [SopController::class, 'destroy'])->name('admin.sop.destroy')->middleware('auth');


// Route Management Kontak Pada Admin
Route::get('/kontak', [ContactController::class, 'index'])->name('contacts.index')->middleware('auth');
Route::post('/kontak', [ContactController::class, 'update'])->name('contacts.update')->middleware('auth');
Route::get('/user.footer', [ContactController::class, 'index'])->name('contacts.index')->middleware('auth');

Route::get('/download/pengaduan', [PengaduanController::class, 'downloadLaporan'])->name('download.pengaduan');


Route::get('/profile', [AdminProfileController::class, 'index'])->name('admin.profile');
Route::put('/profile/{id}', [AdminProfileController::class, 'update'])->name('admin.profile.update');