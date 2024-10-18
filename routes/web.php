<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SopController;

// -----------------------------
// Auth Routes
// -----------------------------

// Halaman utama: Menampilkan halaman login sebagai default
Route::get('/', function () {
    return view('login');
})->name('login');

// Halaman login dan proses login
Route::get('login', function () {
    return view('login');
})->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.submit');

// Halaman register dan proses register
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Halaman reset password
Route::get('password/reset', function () {
    return view('auth.passwords.email');
})->name('password.request');

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
Route::get('/pengaduan/{id}', [PengaduanController::class, 'show'])->name('pengaduan.show');

// Form pengaduan (tanpa middleware)
Route::patch('/home', [PengaduanController::class, 'create'])->name('pengaduan.form');


// -----------------------------
// Superadmin Routes
// -----------------------------

// Halaman dashboard superadmin
Route::get('/dasboardsuper', function () {
    return view('superadmin.dasboard');
})->name('superadmin.dasboard');

// Halaman user management superadmin
Route::get('/usersuper', function () {
    return view('superadmin.user');
})->name('superadmin.user');

// Halaman SOP management superadmin
Route::get('/sopsuper', [SopController::class, 'index'])->name('superadmin.sop.index');
Route::post('/sopsuper', [SopController::class, 'store'])->name('superadmin.sop.store');
Route::get('/sopsuper/{id}/edit', [SopController::class, 'edit'])->name('superadmin.sop.edit');
Route::put('/sopsuper/{id}', [SopController::class, 'update'])->name('superadmin.sop.update');
Route::delete('/sopsuper/{id}', [SopController::class, 'destroy'])->name('superadmin.sop.destroy');

// Halaman pengaduan superadmin
Route::get('/pengaduansuper', [PengaduanController::class, 'superAdminIndex'])->name('superadmin.pengaduan');
Route::get('/pengaduansuper/{id}/tindak-lanjut', [PengaduanController::class, 'showTindakLanjutsuper'])->name('superadmin.tindak-lanjut');
Route::put('/pengaduansuper/{id}', [PengaduanController::class, 'update'])->name('superadmin.pengaduan.update')->middleware('auth');
// Halaman kontak management superadmin

// Halaman Data Admin superadmin
// Route::get('/kontaksuper', [ContactOptionController::class, 'SuperAdminindex'])->name('contacts.SuperAdminindex');
// Route::post('/kontaksuper', [ContactOptionController::class, 'update'])->name('contacts.update');

// Route::get('/adminsuper', [DashboardController::class, 'admin'])->name('superadmin.admin');
// Route::get('/usersuper', [DashboardAController::class, 'users'])->name('superadmin.user');


require __DIR__.'/admin.php';
require __DIR__.'/superadmin.php';