<?php

use App\Http\Controllers\Admin\SopController as AdminSopController;
use App\Http\Controllers\SuperAdmin\SopController;
use App\Http\Controllers\SuperAdmin\UsersController;
use App\Http\Controllers\SuperAdmin\AdminsController;
use App\Http\Controllers\SuperAdmin\ContactController;
use App\Http\Controllers\SuperAdmin\PelaporanController;
use App\Http\Controllers\SuperAdmin\DashboardController;
use App\Http\Controllers\SuperAdmin\PengaduanController;
use App\Http\Controllers\SuperAdmin\SuperAdminProfileController;
use Illuminate\Support\Facades\Route;

// Route Management Dashboard Super Admin
Route::get('/super-dashboard', [DashboardController::class, 'index'])->name('superadmin.dashboard')->middleware('is_superadmin');
Route::get('/adminsuper', [DashboardController::class, 'admin'])->name('superadmin.admin')->middleware('is_superadmin');
Route::get('/usersuper', [DashboardController::class, 'users'])->name('superadmin.user')->middleware('is_superadmin');

// Route Management Data Pengadu Pada Super Admin
Route::get('/usersuper', [UsersController::class, 'showUser'])->name('superadmin.user')->middleware('is_superadmin');
Route::get('/superadmin/users/{id}/edit', [UsersController::class, 'edit'])->name('superadmin.users.edit')->middleware('is_superadmin');
Route::put('/superadmin/users/{id}', [UsersController::class, 'update'])->name('superadmin.users.update')->middleware('is_superadmin');
Route::delete('/superadmin/users/{id}', [UsersController::class, 'destroy'])->name('superadmin.users.destroy')->middleware('is_superadmin');

// Route Management Data Admin Pada Super Admin
Route::get('/adminsuper', [AdminsController::class, 'index'])->name('superadmin.admin')->middleware('is_superadmin');
Route::get('/adminsuper/create', [AdminsController::class, 'create'])->name('superadmin.admin.create')->middleware('is_superadmin');
Route::post('/adminsuper', [AdminsController::class, 'store'])->name('superadmin.admin.store')->middleware('is_superadmin');
Route::get('/adminsuper/{id}/edit', [AdminsController::class, 'edit'])->name('superadmin.admin.edit')->middleware('is_superadmin');
Route::put('/adminsuper/{id}', [AdminsController::class, 'update'])->name('superadmin.admin.update')->middleware('is_superadmin');
Route::delete('/adminsuper/{id}', [AdminsController::class, 'destroy'])->name('superadmin.admin.destroy')->middleware('is_superadmin');

// Route Management Pengaduan Pada Super Admin
Route::get('/pengaduansuper', [PengaduanController::class, 'superAdminIndex'])->name('superadmin.pengaduan')->middleware('is_superadmin');
Route::get('/pengaduansuper/{id}/tindak-lanjut', [PengaduanController::class, 'showTindakLanjutsuper'])->name('superadmin.tindak-lanjut')->middleware('is_superadmin');
Route::put('/pengaduansuper/{id}', [PengaduanController::class, 'update'])->name('superadmin.pengaduan.update')->middleware('auth')->middleware('is_superadmin');;

// Route Management Pelaporan Pada Super Admin
Route::get('/pelaporan', [PelaporanController::class, 'index'])->name('pelaporan');

// Route Management SOP Pada Super Admin
Route::get('/sopsuper', [SopController::class, 'index'])->name('superadmin.sop.index')->middleware('is_superadmin');
Route::post('/sopsuper', [SopController::class, 'store'])->name('superadmin.sop.store')->middleware('is_superadmin');
Route::get('/sopsuper/{id}/edit', [SopController::class, 'edit'])->name('superadmin.sop.edit')->middleware('is_superadmin');
Route::put('/sopsuper/{id}', [SopController::class, 'update'])->name('superadmin.sop.update')->middleware('is_superadmin');
Route::delete('/sopsuper/{id}', [SopController::class, 'destroy'])->name('superadmin.sop.destroy')->middleware('is_superadmin');

// Route Management Kontak Pada Super admin
Route::get('/kontaksuper', [ContactController::class, 'index'])->name('contacts.index')->middleware('is_superadmin');
Route::post('/kontaksuper', [ContactController::class, 'update'])->name('contacts.update.super')->middleware('is_superadmin');


Route::get('/profile-super', [SuperAdminProfileController::class, 'index'])->name('superadmin.profile')->middleware('is_superadmin');
Route::put('/profile-super/{id}', [SuperAdminProfileController::class, 'update'])->name('superadmin.profile.update')->middleware('is_superadmin');