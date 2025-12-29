<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LamarController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Models\Lowongan;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PerusahaanController;

// ROUTE BAGIAN USER
// homepage should be beranda; login page at /login
Route::get('/', function () { return redirect()->route('home'); });
Route::get('/login',[UserController::class,'formLogin'])->name('login');
Route::post('/login',[UserController::class,'login'])->name('login.process');
Route::post('/logout',[UserController::class,'logout'])->name('logout');
Route::get('/register',[UserController::class,'formRegister'])->name('register');
Route::post('/register',[UserController::class,'register'])->name('register.process');
Route::get('/beranda',[UserController::class,'beranda'])->name('home');
Route::get('/lowongan/{id}', [UserController::class, 'show'])->name('lowongan.detail');
Route::get('/user/lowongan-tersimpan',[LowonganController::class, 'simpan'])->name('lowongan_tersimpan');
Route::post('/lowongan/{id}/simpan',[LowonganController::class, 'toggleSimpanSession'])->name('lowongan.simpan');
Route::get('/simpan',[LowonganController::class, 'tersimpanSession'])->name('lowongan_tersimpan');
Route::get('/status-lamaran', [UserController::class, 'statuslamaran'])->name('status.lamaran');

Route::get('/status-lamaran', [UserController::class, 'statuslamaran'])
    ->middleware('auth')
    ->name('status.lamaran');


// Lamar routes require authenticated users
Route::middleware('auth')->group(function () {

    Route::get('/lamar-pekerjaan/{lowongan}/step1', function (Lowongan $lowongan) {
        return view('user.lamar-step1', compact('lowongan'));
    })->name('lamar.step1');

    Route::post('/lamar-pekerjaan/{lowongan}/step1',
        [LamarController::class, 'storeStep1']
    )->name('lamar.step1.store');


    Route::get('/lamar-pekerjaan/{lowongan}/step2', function (Lowongan $lowongan) {
        return view('user.lamar-step2', compact('lowongan'));
    })->name('lamar.step2');

    Route::post('/lamar-pekerjaan/{lowongan}/step2',
        [LamarController::class, 'storeStep2']
    )->name('lamar.step2.store');


    Route::get('/lamar-pekerjaan/{lowongan}/step3', function (Lowongan $lowongan) {
        $profile = Profile::where('user_id', Auth::id())->first();
        return view('user.lamar-step3', compact('lowongan', 'profile'));
    })->name('lamar.step3');

    Route::post('/lamar-pekerjaan/{lowongan}/submit',
        [LamarController::class, 'submit']
    )->name('lamar.submit');
});


Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'show'])
        ->name('profile.show');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::post('/profile/update', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::get('/profile/view/{type}', [ProfileController::class, 'view'])
        ->name('profile.view');

});

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
Route::get('/informasi-lowongan', [PerusahaanController::class, 'GetLowongan'])->name('informasi-lowongan');
Route::get('/informasi-lowongan/edit/{id}', [PerusahaanController::class, 'editLowongan'])->name('edit-lowongan');
Route::put('/informasi-lowongan/update/{id}', [PerusahaanController::class, 'updateLowongan'])->name('update-lowongan');
Route::get('/tambah-lowongan', [PerusahaanController::class,'formLowongan'])->name('tambah-lowongan');
Route::post('/tambah-lowongan', [PerusahaanController::class,'addLowongan'])->name('tambah-lowongan.process');
Route::get('/informasi-lowongan/{id}',[PerusahaanController::class, 'detailLowongan'])->name('detail-lowongan');

//admin
//Route::get('/dashboard', [CompanyController::class, 'dashboard'])->name('dashboard');
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
Route::get('/admin/perusahaan', [CompanyController::class, 'index'])->name('perusahaan');
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::post('/admin/lowongan/{id}/approve', [AdminController::class, 'approve'])->name('lowongan.approve');
Route::post('/admin/lowongan/{id}/reject', [AdminController::class, 'reject'])->name('lowongan.reject');
