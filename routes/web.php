<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LowonganController;
use App\Models\Lowongan;

Route::get('/beranda', function () {
    return view('beranda');
});

Route::get('/informasi-lowongan', function () {
    return view('info_lowongan');
});

