<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengaduanController;

// Halaman Awal Saat Website Diakses
Route::get('/', function() {
    return view('login');
});

Route::get('/home', function() {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

// Halaman reset password
Route::get('password/reset', function () {
    return view('auth.passwords.email');
})->name('password.request')->middleware('auth');



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
Route::get('/pengaduan/{id}', [PengaduanController::class, 'show'])->name('pengaduan.show')->middleware('auth');

// Form pengaduan (tanpa middleware)
Route::patch('/home', [PengaduanController::class, 'create'])->name('pengaduan.form')->middleware('auth');
Route::put('/pengaduan/{id}', [PengaduanController::class, 'update'])->name('pengaduan.update')->middleware('auth');
Route::patch('/home', [PengaduanController::class, 'create'])->name('pengaduan.index')->middleware('auth');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/pengadu.php';
require __DIR__ . '/superadmin.php';