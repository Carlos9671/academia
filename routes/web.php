<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GymController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\CheckInController;

Route::resource('gyms', GymController::class);
Route::resource('members', MemberController::class);
Route::get('/checkin/{token}', [CheckInController::class, 'show'])->name('checkin.show');
Route::post('/checkin/{token}', [CheckInController::class,'store'])->name('checkin.store');

Route::get('/', function () {
    return view('layouts.app');
});


//autentificação do usuário no app
use App\Http\Controllers\Auth\MemberAuthController;

Route::get('/login', [MemberAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [MemberAuthController::class, 'login'])->name('login.store');
Route::post('/logout', [MemberAuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/app', function () {
        return view('app.home');
    })->name('app.home');

    Route::get('/senha', [App\Http\Controllers\Auth\PasswordController::class, 'edit'])->name('senha.edit');
    Route::put('/senha', [App\Http\Controllers\Auth\PasswordController::class, 'update'])->name('senha.update');
});