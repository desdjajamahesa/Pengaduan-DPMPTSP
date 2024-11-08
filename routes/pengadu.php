<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\SopController;
use App\Http\Controllers\User\StatistikController;

// Route Statistik
Route::get('/home', [StatistikController::class, 'index'])->name('home')->middleware('auth');

// Route SOP
Route::get('/home/sop', [SopController::class, 'show'])->name('sop.index')->middleware('auth');