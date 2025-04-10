<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/availability', [App\Http\Controllers\AvailabilityController::class, 'index'])->name('availability.index');
    Route::get('/availability/create', [App\Http\Controllers\AvailabilityController::class, 'create'])->name('availability.create');
    Route::post('/availability', [App\Http\Controllers\AvailabilityController::class, 'store'])->name('availability.store');
    Route::resource('categories', \App\Http\Controllers\CategoryController::class);
});

//Route::resource('categories', \App\Http\Controllers\CategoryController::class)->middleware(['auth', 'role:admin']);
Route::get('/', [App\Http\Controllers\Frontend\AvailabilityController::class, 'index'])->name('frontend.availability');

require __DIR__.'/auth.php';
