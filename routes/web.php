<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LamarController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PerusahaanController;

// ROUTE BAGIAN USER
Route::get('/', function () {return view('user.login');})->name('login');
Route::get('/beranda', function () {return view('user.beranda');})->name('home');

Route::get('/informasi-lowongan-kerja', function () {return view('user.info-lowongan');})->name('info_lowongan');

Route::get('/user/lowongan-tersimpan', function () {
    $jobs = [
        ['title' => 'Admin Toko Online', 'company' => 'GlobalTrans Indo'],
        ['title' => 'Desain Grafis', 'company' => 'GlobalTrans Indo'],
        ['title' => 'Data Entry Operator', 'company' => 'GlobalTrans Indo'],
        ['title' => 'Admin Sosial Media', 'company' => 'GlobalTrans Indo'],
    ];return view('user.lowongan-tersimpan', compact('jobs'));})->name('lowongan_tersimpan');

Route::get('/lamar-pekerjaan/step1', function () {return view('user.lamar-step1');})->name('lamar.step1');

Route::get('/lamar-pekerjaan/step2', function () {return view('user.lamar-step2');})->name('lamar.step2');

Route::get('/lamar-pekerjaan/step3', function () {return view('user.lamar-step3');})->name('lamar.step3');

Route::post('/lamar-pekerjaan/submit', [LamarController::class, 'submit'])->name('lamar.submit');

Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/profile/view/{type}', [ProfileController::class, 'view'])
    ->name('profile.view');

// ROUTE PELATIHAN
// SEO
Route::get('/pelatihan/seo', function () { return view('user.pelatihan.seo'); })->name('seo');
Route::get('/pelatihan/seo/materi1', function () { return view('user.pelatihan.materi1_seo'); })->name('materi1');
Route::get('/pelatihan/seo/materi2', function () { return view('user.pelatihan.materi2_seo'); })->name('materi2');
Route::get('/pelatihan/seo/materi3', function () { return view('user.pelatihan.materi3_seo'); })->name('materi3');

// Marketing
Route::get('/pelatihan/marketing', function () { return view('user.pelatihan.marketing'); })->name('marketing');
Route::get('/pelatihan/marketing/materi1', function () { return view('user.pelatihan.materi1_marketing'); })->name('marketing_materi1');
Route::get('/pelatihan/marketing/materi2', function () { return view('user.pelatihan.materi2_marketing'); })->name('marketing_materi2');
Route::get('/pelatihan/marketing/materi3', function () { return view('user.pelatihan.materi3_marketing'); })->name('marketing_materi3');

// Copywritting
Route::get('/pelatihan/copywritting', function () { return view('user.pelatihan.copywritting'); })->name('copywritting');
Route::get('/pelatihan/copywritting/materi1', function () { return view('user.pelatihan.materi1_copywritting'); })->name('copywritting_materi1');
Route::get('/pelatihan/copywritting/materi2', function () { return view('user.pelatihan.materi2_copywritting'); })->name('copywritting_materi2');
Route::get('/pelatihan/copywritting/materi3', function () { return view('user.pelatihan.materi3_copywritting'); })->name('copywritting_materi3');

// Data Analyst
Route::get('/pelatihan/dataanalyst', function () { return view('user.pelatihan.dataanalyst'); })->name('dataanalyst');
Route::get('/pelatihan/dataanalyst/materi1', function () { return view('user.pelatihan.materi1_dataanalyst'); })->name('dataanalyst_materi1');
Route::get('/pelatihan/dataanalyst/materi2', function () { return view('user.pelatihan.materi2_dataanalyst'); })->name('dataanalyst_materi2');
Route::get('/pelatihan/dataanalyst/materi3', function () { return view('user.pelatihan.materi3_dataanalyst'); })->name('dataanalyst_materi3');

// ROUTE BAGIAN PERUSAHAAN
Route::get('/login-penyedia', [PerusahaanController::class, 'showLogin'])->name('login-perusahaan');
Route::post('/login-penyedia', [PerusahaanController::class, 'login'])->name('hit-login-perusahaan');
Route::get('/perusahaan/dashboard', [PerusahaanController::class, 'dashboard'])->name('perusahaan-dashboard');
Route::get('/logout-perusahaan', [PerusahaanController::class, 'logout'])->name('logout-perusahaan');

Route::get('/informasi-lowongan', function () {return view('perusahaan.views');});
Route::get('/edit-lowongan', function () {return view('perusahaan.edit');});
Route::get('/tambah-lowongan', function () {return view('perusahaan.form');});

//melani
Route::get('/dashboard', [CompanyController::class, 'dashboard'])->name('dashboard');
Route::get('/perusahaan', [CompanyController::class, 'index'])->name('perusahaan');

//melani untuk status admin
Route::post('/companies/{id}/approve', [CompanyController::class, 'approve'])->name('companies.approve');
Route::post('/companies/{id}/reject', [CompanyController::class, 'reject'])->name('companies.reject');

// Tampil halaman login admin
Route::get('/admin/login', function () {return view('auth.login-admin');})->name('admin.login');

// Proses login admin (POST)
Route::post('/admin/login', function () {return redirect()->route('dashboard');})->name('admin.login.submit');
Route::get('/admin/logout', function () {session()->flush(); return redirect('/admin/login'); })->name('admin.logout');

