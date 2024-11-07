<?php

use App\Http\Controllers\Admin\SopController as AdminSopController;
use App\Http\Controllers\SuperAdmin\UsersController;
use App\Http\Controllers\SuperAdmin\AdminsController;
use App\Http\Controllers\SuperAdmin\DashboardController;
use App\Http\Controllers\SuperAdmin\ContactController;
use App\Http\Controllers\SuperAdmin\SopController;
use App\Http\Controllers\SuperAdmin\PengaduanController;
use Illuminate\Support\Facades\Route;

// -----------------------------------------
// Route Management Dashboard Super Admin
// -----------------------------------------

Route::get('/super-dashboard', [DashboardController::class, 'index'])->name('superadmin.dashboard')->middleware('auth');

// Route untuk Admin dan User di Super Admin Dashboard
Route::get('/adminsuper', [DashboardController::class, 'admin'])->name('superadmin.admin')->middleware('auth');
Route::get('/usersuper', [DashboardController::class, 'users'])->name('superadmin.user')->middleware('auth');

// Kontak Management di Super Admin Dashboard
Route::get('/kontaksuper', [ContactController::class, 'index'])->name('contacts.index')->middleware('auth');
Route::post('/kontaksuper', [ContactController::class, 'update'])->name('contacts.update')->middleware('auth');

// Admin Management di Super Admin Dashboard
Route::get('/adminsuper', [AdminsController::class, 'index'])->name('superadmin.admin')->middleware('auth');
Route::get('/adminsuper/create', [AdminsController::class, 'create'])->name('superadmin.admin.create')->middleware('auth');
Route::post('/adminsuper', [AdminsController::class, 'store'])->name('superadmin.admin.store')->middleware('auth');
Route::get('/adminsuper/{id}/edit', [AdminsController::class, 'edit'])->name('superadmin.admin.edit')->middleware('auth');
Route::put('/adminsuper/{id}', [AdminsController::class, 'update'])->name('superadmin.admin.update')->middleware('auth');
Route::delete('/adminsuper/{id}', [AdminsController::class, 'destroy'])->name('superadmin.admin.destroy')->middleware('auth');

// User Management di Super Admin Dashboard
Route::get('/usersuper', [UsersController::class, 'showUsers'])->name('superadmin.user')->middleware('auth');
Route::get('/superadmin/users/{id}/edit', [UsersController::class, 'edit'])->name('superadmin.users.edit')->middleware('auth');
Route::put('/superadmin/users/{id}', [UsersController::class, 'update'])->name('superadmin.users.update')->middleware('auth');
Route::delete('/superadmin/users/{id}', [UsersController::class, 'destroy'])->name('superadmin.users.destroy')->middleware('auth');

// SOP Management di Super Admin Dashboard
Route::get('/sopsuper', [SopController::class, 'index'])->name('superadmin.sop.index')->middleware('auth');
Route::post('/sopsuper', [SopController::class, 'store'])->name('superadmin.sop.store')->middleware('auth');
Route::get('/sopsuper/{id}/edit', [SopController::class, 'edit'])->name('superadmin.sop.edit')->middleware('auth');
Route::put('/sopsuper/{id}', [SopController::class, 'update'])->name('superadmin.sop.update')->middleware('auth');
Route::delete('/sopsuper/{id}', [SopController::class, 'destroy'])->name('superadmin.sop.destroy')->middleware('auth');

// Pengaduan Management di Super Admin Dashboard
Route::get('/pengaduansuper', [PengaduanController::class, 'superAdminIndex'])->name('superadmin.pengaduan')->middleware('auth');
Route::get('/pengaduansuper/{id}/tindak-lanjut', [PengaduanController::class, 'showTindakLanjutsuper'])->name('superadmin.tindak-lanjut')->middleware('auth');
Route::put('/pengaduansuper/{id}', [PengaduanController::class, 'update'])->name('superadmin.pengaduan.update')->middleware('auth')->middleware('auth');;
