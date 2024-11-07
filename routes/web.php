<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PelaporanController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SopController;

// -----------------------------
// Auth Routes
// -----------------------------

// Halaman utama: Menampilkan halaman login sebagai default

// Halaman login dan proses login
Route::get('login', function () {
    return view('login');
})->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.submit')->middleware('auth');;

// Halaman register dan proses register
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register')->middleware('auth');;
Route::post('register', [RegisterController::class, 'register'])->middleware('auth');;

// Halaman reset password
Route::get('password/reset', function () {
    return view('auth.passwords.email');
})->name('password.request')->middleware('auth');;

// -----------------------------
// User Routes (Authenticated)
// -----------------------------

// Halaman home user (hanya bisa diakses oleh user yang sudah login)
Route::get('/home', function () {
    return view('user.home');
})->name('home')->middleware('auth');

Route::get('/home', function () {
    return view('user.home');
})->name('sop.index')->middleware('auth');


Route::get('/detail', function () {
    return view('user.detail');
})->name('detail')->middleware('auth');

// View User
Route::get('/pengaduan/{id}', [PengaduanController::class, 'show'])->name('pengaduan.show')->middleware('auth');;

// Form pengaduan (tanpa middleware)
Route::patch('/home', [PengaduanController::class, 'create'])->name('pengaduan.form')->middleware('auth');;
Route::put('/pengaduan/{id}', [PengaduanController::class, 'update'])->name('pengaduan.update')->middleware('auth');
Route::patch('/home', [PengaduanController::class, 'create'])->name('pengaduan.index')->middleware('auth');;
// -----------------------------
// Superadmin Routes
// -----------------------------




// Halaman pengaduan superadmin

// Halaman kontak management superadmin

// Halaman Data Admin superadmin
// Route::get('/kontaksuper', [ContactOptionController::class, 'SuperAdminindex'])->name('contacts.SuperAdminindex');
// Route::post('/kontaksuper', [ContactOptionController::class, 'update'])->name('contacts.update');

// Route::get('/adminsuper', [DashboardController::class, 'admin'])->name('superadmin.admin');
// Route::get('/usersuper', [DashboardAController::class, 'users'])->name('superadmin.user');


// Route Pelaporan Admin dan Super Admin
Route::get('/pelaporan', [PelaporanController::class, 'index'])->name('pelaporan');

require __DIR__ . '/admin.php';
require __DIR__ . '/superadmin.php';
