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
Route::get('/users', [UsersController::class, 'showUser'])->name('admin.user')->middleware('is_admin');
Route::get('/users/{id}/edit', [UsersController::class, 'edit'])->name('admin.users.edit')->middleware('is_admin');
Route::put('/users/{id}', [UsersController::class, 'update'])->name('admin.users.update')->middleware('is_admin');
Route::delete('/users/{id}', [UsersController::class, 'destroy'])->name('admin.users.destroy')->middleware('is_admin');

// Route Management Pengaduan Pada Admin
Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('admin.pengaduan')->middleware('is_admin');
Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store')->middleware('is_admin');
Route::get('/pengaduan/{id}/tindak-lanjut', [PengaduanController::class, 'showTindakLanjut'])->name('admin.pengaduan.tindak-lanjut')->middleware('is_admin');
Route::put('/pengaduan/{id}', [PengaduanController::class, 'update'])->name('admin.pengaduan.update')->middleware('is_admin');
Route::put('/pengaduan/{id}/tindak-lanjut/update', [PengaduanController::class, 'update'])->name('admin.pengaduan.update')->middleware('is_admin');
Route::patch('/pengaduan/{id}/batalkan', [PengaduanController::class, 'batalkan'])->name('pengaduan.batalkan')->middleware('is_admin');
Route::get('/pengaduan/{id}/download', [PengaduanController::class, 'download'])->name('pengaduan.download');

// Route Management Pelaporan Pada Admin
Route::get('/pelaporan', [PelaporanController::class, 'index'])->name('pelaporan');

// Route Management Statistik Pengaduan Pada Admin
Route::get('/export/pengaduan', [PelaporanController::class, 'exportPengaduan'])->name('export.pengaduan');

// Route Management SOP Pada Admin
Route::get('/sop', [SopController::class, 'index'])->name('admin.sop.index')->middleware('is_admin');
Route::post('/sop', [SopController::class, 'store'])->name('admin.sop.store')->middleware('is_admin');
Route::get('/sop/{id}/edit', [SopController::class, 'edit'])->name('admin.sop.edit')->middleware('is_admin');
Route::put('/sop/{id}', [SopController::class, 'update'])->name('admin.sop.update')->middleware('is_admin');
Route::delete('/sop/{id}', [SopController::class, 'destroy'])->name('admin.sop.destroy')->middleware('is_admin');


// Route Management Kontak Pada Admin
Route::get('/kontak', [ContactController::class, 'index'])->name('contacts.index')->middleware('is_admin');
Route::post('/kontak', [ContactController::class, 'update'])->name('contacts.update')->middleware('is_admin');
Route::get('/user.footer', [ContactController::class, 'index'])->name('contacts.index')->middleware('is_admin');

Route::get('/download/pengaduan', [PengaduanController::class, 'downloadLaporan'])->name('download.pengaduan');


Route::get('/profile', [AdminProfileController::class, 'index'])->name('admin.profile')->middleware('is_admin');
Route::put('/profile/{id}', [AdminProfileController::class, 'update'])->name('admin.profile.update')->middleware('is_admin');