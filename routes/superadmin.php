<?php

use App\Http\Controllers\SuperAdmin\UsersController;
use App\Http\Controllers\SuperAdmin\AdminsController;
use App\Http\Controllers\SuperAdmin\DashboardController;
use App\Http\Controllers\SuperAdmin\ContactController;
use Illuminate\Support\Facades\Route;

// Route Management Dashboard Super Admin
Route::get('/super-dashboard', [DashboardController::class, 'index'])->name('superadmin.dashboard');


Route::get('/adminsuper', [DashboardController::class, 'admin'])->name('superadmin.admin');
Route::get('/usersuper', [DashboardController::class, 'users'])->name('superadmin.user');

Route::get('/kontaksuper', [ContactController::class, 'index'])->name('contacts.index');
Route::post('/kontaksuper', [ContactController::class, 'update'])->name('contacts.update');

Route::get('/adminsuper', [AdminsController::class, 'index'])->name('superadmin.admin');
Route::get('/adminsuper/create', [AdminsController::class, 'create'])->name('superadmin.admin.create');
Route::post('/adminsuper', [AdminsController::class, 'store'])->name('superadmin.admin.store');
Route::get('/adminsuper/{id}/edit', [AdminsController::class, 'edit'])->name('superadmin.admin.edit');
Route::put('/adminsuper/{id}', [AdminsController::class, 'update'])->name('superadmin.admin.update');
Route::delete('/adminsuper/{id}', [AdminsController::class, 'destroy'])->name('superadmin.admin.destroy');


Route::get('/usersuper', [UsersController::class, 'showUsers'])->name('superadmin.user');
Route::get('/superadmin/users/{id}/edit', [UsersController::class, 'edit'])->name('superadmin.user.edit');
Route::put('/superadmin/users/{id}', [UsersController::class, 'update'])->name('superadmin.user.update');
Route::delete('/superadmin/users/{id}', [UsersController::class, 'destroy'])->name('superadmin.user.destroy');
