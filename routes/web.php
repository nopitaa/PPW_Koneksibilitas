<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LowonganController;
use App\Models\Lowongan;
use App\Http\Controllers\ProfileController;


Route::get('/beranda', function () {
    return view('beranda');
})->name('home'); //

Route::get('/informasi-lowongan', function () {
    return view('info_lowongan');
});

Route::get('/', fn () => redirect()->route('profile.show'));

Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::post('/profile/update-about', [ProfileController::class, 'updateAbout'])->name('profile.updateAbout');
