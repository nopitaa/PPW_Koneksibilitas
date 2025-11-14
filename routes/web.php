<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LamarController;
use App\Http\Controllers\CompanyController;

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


// ROUTE BAGIAN PERUSAHAAN
Route::get('/login-penyedia', function () {return view('perusahaan.login');})->name('login-perusahaan');
Route::get('/perusahaan/dashboard', function () {return view('perusahaan.Dashboard');})->name('perusahaan-dashboard');

Route::get('/informasi-lowongan', function () {return view('perusahaan.views');});

Route::get('/edit-lowongan', function () {return view('perusahaan.edit');});

Route::get('/tambah-lowongan', function () {return view('perusahaan.form');});

// Route::get('/dashboard', [CompanyController::class, 'dashboard'])->name('dashboard');
// Route::get('/perusahaan', [CompanyController::class, 'index'])->name('perusahaan');

// ROUTE ADMIN
Route::post('/companies/{id}/approve', [CompanyController::class, 'approve'])->name('companies.approve');
Route::post('/companies/{id}/reject', [CompanyController::class, 'reject'])->name('companies.reject');

// ROUTE ADMIN
Route::get('/admin/dashboard', [CompanyController::class, 'dashboard'])->name('dashboard');

// Route untuk halaman perusahaan (daftar lowongan disetujui)
Route::get('/admin/perusahaan', [CompanyController::class, 'index'])->name('perusahaan');

// ROUTE AUTH 
// Route::get('/', function () {return redirect()->route('login');});

// Route::get('/login', function () {return view('auth.login');})->name('login');
// // mengarah ke resources/views/auth/login.blade.php

// Route::post('/login', function (Request $request) {
//     $email = $request->input('email');
//     $password = $request->input('password');

//     // nanti ganti Auth::user()->role BE
//     if ($email === 'admin@gmail.com') {
//         $role = 1;
//     } elseif ($email === 'perusahaan@gmail.com') {
//         $role = 2;
//     } else {
//         $role = 3;
//     }

//     // switch case role
//     switch ($role) {
//         case 1:
//             return redirect('/admin/dashboard');
//         case 2:
//             return redirect('/perusahaan/dashboard');
//         case 3:
//             return redirect('/beranda');
//         default:
//             return redirect('/login')->with('error', 'Role tidak dikenal.');
//     }})->name('login.submit');