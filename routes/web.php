<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LowonganController;
use App\Models\Lowongan;
use App\Http\Controllers\ProfileController;


Route::get('/beranda', function () {
    return view('user.beranda');  
})->name('home');
//ROUTE BAGIAN USER
Route::get('/informasi-lowongan-kerja', function () {
    return view('user.info-lowongan');
})->name('info_lowongan');

Route::get('/lamar-pekerjaan/step1', function () {
    return view('user.lamar-step1');
})->name('lamar.step1');

Route::get('/lamar-pekerjaan/step2', function () {
    return view('user.lamar-step2');
})->name('lamar.step2');

Route::get('/lamar-pekerjaan/step3', function () {
    return view('user.lamar-step3');
})->name('lamar.step3');

Route::post('/lamar-pekerjaan/submit', [\App\Http\Controllers\LamarController::class, 'submit'])
     ->name('lamar.submit');

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
