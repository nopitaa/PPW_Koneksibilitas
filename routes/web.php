<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\ProfileController;

// ROUTE BAGIAN USER
Route::get('/beranda', function () {
    return view('user.beranda');
})->name('home');

Route::get('/', fn () => redirect()->route('home'));

Route::get('/informasi-lowongan-kerja', function () {
    return view('user.info-lowongan');
})->name('info_lowongan');

Route::get('/user/lowongan-tersimpan', function () {
    return view('user.lowongan-tersimpan');
})->name('lowongan_tersimpan');

Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::post('/profile/update-about', [ProfileController::class, 'updateAbout'])->name('profile.updateAbout');

// ROUTE BAGIAN PERUSAHAAN
Route::get('/dashboard-perusahaan', function () {
    return view('perusahaan.Dashboard');
});

Route::get('/informasi-lowongan', function () {
    return view('perusahaan.views');
});

Route::get('/edit-lowongan', function () {
    return view('perusahaan.edit');
});

Route::get('/tambah-lowongan', function () {
    return view('perusahaan.form');
});

Route::get('/user/lowongan-tersimpan', function () {
    $jobs = [
        ['title' => 'Admin Toko Online', 'company' => 'GlobalTrans Indo'],
        ['title' => 'Desain Grafis', 'company' => 'GlobalTrans Indo'],
        ['title' => 'Data Entry Operator', 'company' => 'GlobalTrans Indo'],
        ['title' => 'Admin Sosial Media', 'company' => 'GlobalTrans Indo'],
    ];

    return view('user.lowongan-tersimpan', compact('jobs'));
})->name('lowongan_tersimpan');
