<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LowonganController;
use App\Models\Lowongan;
use App\Http\Controllers\ProfileController;


Route::get('/beranda', function () {
    return view('beranda');
})->name('home');

Route::get('/', fn () => redirect()->route('profile.show'));
//ROUTE BAGIAN USER
Route::get('/informasi-lowongan-kerja', function () {
    return view('info-lowongan');
})->name('info_lowongan');

Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::post('/profile/update-about', [ProfileController::class, 'updateAbout'])->name('profile.updateAbout');

//ROUTE BAGIAN PERUSAHAAN
Route::get('/dashboard-perusahaan', function () {
    return view('/perusahaan/Dashboard');
});
Route::get('/informasi-lowongan', function () {
    return view('perusahaan/views');
});
Route::get('/edit-lowongan', function () {
    return view('perusahaan/edit');
});
//nnti nana update routesnya, update controller juga
Route::get('/tambah-lowongan', function () {
    return view('/perusahaan/form');
});
