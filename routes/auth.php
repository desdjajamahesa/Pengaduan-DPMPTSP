<?php 

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Route Register
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Route Login
Route::get('login', function () {
  return view('login');
})->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');