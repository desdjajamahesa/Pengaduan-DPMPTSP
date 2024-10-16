<?php

use App\Http\Controllers\SuperAdmin\DashboardController;
use Illuminate\Support\Facades\Route;

// Route Management Dashboard Super Admin
Route::get('/super-dashboard', [DashboardController::class, 'index'])->name('superadmin.dashboard');