<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LowonganController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\LamaranController;
use App\Http\Controllers\Api\KeterampilanController;

/*
|--------------------------------------------------------------------------
| Public API Routes (No Authentication Required)
|--------------------------------------------------------------------------
*/

// Authentication
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Public Lowongan (hanya yang approved)
Route::get('/lowongan', [LowonganController::class, 'index']);
Route::get('/lowongan/{lowongan_id}', [LowonganController::class, 'show']);

// Public Keterampilan List
Route::get('/keterampilan', [KeterampilanController::class, 'index']);

/*
|--------------------------------------------------------------------------
| Protected API Routes (Authentication Required)
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    // Authentication
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Profile
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::put('/profile', [ProfileController::class, 'update']);
    Route::post('/profile/avatar', [ProfileController::class, 'uploadAvatar']);
    Route::post('/profile/cv', [ProfileController::class, 'uploadCv']);
    Route::get('/profile/skills', [ProfileController::class, 'getSkills']);

    // Lamaran
    Route::get('/lamaran', [LamaranController::class, 'index']);
    Route::get('/lamaran/{id}', [LamaranController::class, 'show']);
    Route::post('/lamaran', [LamaranController::class, 'store']);

    // User Keterampilan
    Route::get('/user/keterampilan', [KeterampilanController::class, 'getUserSkills']);
    Route::post('/user/keterampilan', [KeterampilanController::class, 'syncUserSkills']);
});
