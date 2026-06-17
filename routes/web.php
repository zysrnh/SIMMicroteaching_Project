<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    $role = auth()->user()->role;
    return redirect()->route($role . '.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Super Admin Routes
Route::middleware(['auth', 'verified', 'role:super_admin'])->prefix('super-admin')->name('super_admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard', ['roleName' => 'Super Administrator']);
    })->name('dashboard');
});

// Admin Routes
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard', ['roleName' => 'Admin Koordinator']);
    })->name('dashboard');
});

// Dosen Routes
Route::middleware(['auth', 'verified', 'role:dosen'])->prefix('dosen')->name('dosen.')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard', ['roleName' => 'Dosen Pembimbing']);
    })->name('dashboard');
});

// Mahasiswa Routes
Route::middleware(['auth', 'verified', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard', ['roleName' => 'Mahasiswa']);
    })->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
