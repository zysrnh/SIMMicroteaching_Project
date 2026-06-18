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

// Admin & Super Admin Shared Routes (for User Management)
Route::middleware(['auth', 'verified'])->group(function () {
    // Only super_admin or admin can access these user management routes
    Route::middleware('role:super_admin,admin')->prefix('kelola')->name('admin.users.')->group(function () {
        // We use a generic controller method that takes 'role' as a parameter (e.g. 'dosen' or 'mahasiswa')
        Route::get('/{role}', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('index');
        Route::post('/{role}/import', [\App\Http\Controllers\Admin\UserController::class, 'import'])->name('import');
        Route::get('/{role}/template', [\App\Http\Controllers\Admin\UserController::class, 'downloadTemplate'])->name('template');
        Route::get('/{role}/export', [\App\Http\Controllers\Admin\UserController::class, 'export'])->name('export');
        
        // CRUD Routes
        Route::get('/{role}/create', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('create');
        Route::post('/{role}/store', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('store');
        Route::get('/{role}/{user}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('edit');
        Route::put('/{role}/{user}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('update');
        Route::delete('/{role}/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('destroy');
    });
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
