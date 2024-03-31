<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    # User routes
    Route::delete('user-force-delete/{id}', [UserController::class, 'permanentDelete'])->name('users.force-destroy');
    Route::post('users/restore/{id}', [UserController::class, 'restore'])->name('users.soft-restore');
    Route::get('users/trashed', [UserController::class, 'trashed'])->name('users.trashed');
    Route::resource('users', UserController::class);
});

require __DIR__.'/auth.php';
