<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LamarController;
use App\Http\Controllers\CompanyController;

// ROUTE BAGIAN USER
Route::get('/beranda', function () {
    return view('user.beranda');
})->name('home');

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', function () {
    return view('auth.login'); // mengarah ke resources/views/auth/login.blade.php
})->name('login');

Route::get('/informasi-lowongan-kerja', function () {
    return view('user.info-lowongan');
})->name('info_lowongan');

Route::get('/user/lowongan-tersimpan', function () {
    $jobs = [
        ['title' => 'Admin Toko Online', 'company' => 'GlobalTrans Indo'],
        ['title' => 'Desain Grafis', 'company' => 'GlobalTrans Indo'],
        ['title' => 'Data Entry Operator', 'company' => 'GlobalTrans Indo'],
        ['title' => 'Admin Sosial Media', 'company' => 'GlobalTrans Indo'],
    ];

    return view('user.lowongan-tersimpan', compact('jobs'));
})->name('lowongan_tersimpan');

// ROUTE LAMAR PEKERJAAN
Route::get('/lamar-pekerjaan/step1', function () {
    return view('user.lamar-step1');
})->name('lamar.step1');

Route::get('/lamar-pekerjaan/step2', function () {
    return view('user.lamar-step2');
})->name('lamar.step2');

Route::get('/lamar-pekerjaan/step3', function () {
    return view('user.lamar-step3');
})->name('lamar.step3');

Route::post('/lamar-pekerjaan/submit', [LamarController::class, 'submit'])->name('lamar.submit');

// ROUTE PROFILE
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::post('/profile/update-about', [ProfileController::class, 'updateAbout'])->name('profile.updateAbout');

// ROUTE BAGIAN PERUSAHAAN
Route::get('/perusahaan/dashboard', function () {
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

Route::get('/dashboard', [CompanyController::class, 'dashboard'])->name('dashboard');
Route::get('/perusahaan', [CompanyController::class, 'index'])->name('perusahaan');

Route::post('/companies/{id}/approve', [CompanyController::class, 'approve'])->name('companies.approve');
Route::post('/companies/{id}/reject', [CompanyController::class, 'reject'])->name('companies.reject');
