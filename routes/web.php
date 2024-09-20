<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SopController;

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

// Halaman home user (hanya bisa diakses oleh user yang sudah login)
Route::get('/home', function () {
    return view('user.home');
})->name('home')->middleware('auth');

// Rute untuk halaman pengaduan (hanya bisa diakses oleh user yang sudah login)
Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('admin.pengaduan')->middleware('auth');
Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store')->middleware('auth');
Route::get('/pengaduan/{id}/tindak-lanjut', [PengaduanController::class, 'showTindakLanjut'])->name('admin.pengaduan.tindak-lanjut')->middleware('auth');
Route::get('/form-pengaduan', [PengaduanController::class, 'create'])->name('pengaduan.form');
Route::post('/store-pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
// Rute untuk menangani pembaruan tindak lanjut pengaduan
Route::put('/pengaduan/{id}', [PengaduanController::class, 'update'])->name('admin.pengaduan.update')->middleware('auth');


// Rute untuk halaman admin (tambahkan middleware auth jika diperlukan)
Route::get('/dasboard', function () {
    return view('admin.dasboard');
})->name('admin.dasboard');

Route::get('/user', function () {
    return view('admin.user');
})->name('admin.user');

Route::get('/kontak', function () {
    return view('admin.kontak');
})->name('admin.kontak');

Route::get('/sop', function () {
    return view('admin.sop');
})->name('admin.sop');


// route superadmin
Route::get('/dasboardsuper', function () {
    return view('superadmin.dasboard');
})->name('superadmin.dasboard');

Route::get('/usersuper', function () {
    return view('superadmin.user');
})->name('superadmin.user');

Route::get('/kontaksuper', function () {
    return view('superadmin.kontak');
})->name('superadmin.kontak');

Route::get('/sopsuper', function () {
    return view('superadmin.sop');
})->name('superadmin.sop');

Route::get('/pengaduansuper', function () {
    return view('superadmin.pengaduan');
})->name('superadmin.pengaduan');

Route::get('/pengaduansuper', [PengaduanController::class, 'superAdminIndex'])->name('superadmin.pengaduan')->middleware('auth');
Route::get('/pengaduansuper/{id}/tindak-lanjut', [PengaduanController::class, 'showTindakLanjut'])->name('superadmin.tindak-lanjut')->middleware('auth');

// Admin routes for SOP management
Route::get('/sop', [SopController::class, 'index'])->name('admin.sop.index');
Route::post('/sop', [SopController::class, 'store'])->name('admin.sop.store');
Route::get('/sop/{id}/edit', [SopController::class, 'edit'])->name('admin.sop.edit');
Route::put('/sop/{id}', [SopController::class, 'update'])->name('admin.sop.update');
Route::delete('/sop/{id}', [SopController::class, 'destroy'])->name('admin.sop.destroy');

// Superadmin routes for SOP management
Route::get('/sopsuper', [SopController::class, 'SuperAdminindex'])->name('superadmin.sop.SuperAdminindex');
Route::post('/sopsuper', [SopController::class, 'store'])->name('superadmin.sop.store')->middleware('auth');
Route::get('/sopsuper/{id}/edit', [SopController::class, 'edit'])->name('superadmin.sop.edit')->middleware('auth');
Route::put('/sopsuper/{id}', [SopController::class, 'update'])->name('superadmin.sop.update')->middleware('auth');
Route::delete('/sopsuper/{id}', [SopController::class, 'destroy'])->name('superadmin.sop.destroy')->middleware('auth');
