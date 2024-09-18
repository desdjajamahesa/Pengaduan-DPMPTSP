<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\RegisterController;

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
