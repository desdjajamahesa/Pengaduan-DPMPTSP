<?php
use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Route;

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

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/pengadu.php';
require __DIR__ . '/superadmin.php';