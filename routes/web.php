<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\OwnerReservationController;

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
    Route::resource('posts', PostController::class);

    Route::get('/mypage', [UserController::class, 'show'])->name('mypage.show');
    Route::get('/mypage/edit', [UserController::class, 'edit'])->name('mypage.edit');
    Route::put('/mypage', [UserController::class, 'update'])->name('mypage.update');

    Route::get('/users/{user}', [UserController::class, 'profile'])->name('users.profile');
    
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/reservations/{reservation}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
    Route::put('/reservations/{reservation}', [ReservationController::class, 'update'])->name('reservations.update');
    Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

    Route::get('/owner/reservations', [OwnerReservationController::class, 'index'])->name('owner.reservations.index');
    Route::get('/owner/reservations/{reservation}', [OwnerReservationController::class, 'show'])->name('owner.reservations.show');
    Route::patch('/owner/reservations/{reservation}/status', [OwnerReservationController::class, 'updateStatus'])->name('owner.reservations.updateStatus');

});

require __DIR__.'/auth.php';
