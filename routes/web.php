<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['reset' => false]);

// Custom password reset with activation code
Route::get('password/reset', [App\Http\Controllers\Auth\PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [App\Http\Controllers\Auth\PasswordResetController::class, 'sendResetCode'])->name('password.email');
Route::get('password/code', [App\Http\Controllers\Auth\PasswordResetController::class, 'showCodeForm'])->name('password.code');
Route::post('password/code', [App\Http\Controllers\Auth\PasswordResetController::class, 'verifyCode'])->name('password.code.verify');
Route::post('password/resend', [App\Http\Controllers\Auth\PasswordResetController::class, 'resendCode'])->name('password.resend');
Route::get('password/reset/{token}', [App\Http\Controllers\Auth\PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [App\Http\Controllers\Auth\PasswordResetController::class, 'resetPassword'])->name('password.update');

Route::get('/register/success', [App\Http\Controllers\Auth\RegisterController::class, 'showSuccess'])->name('register.success');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
