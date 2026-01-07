<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LowonganController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\LamaranController;
use App\Http\Controllers\Api\KeterampilanController;
use App\Http\Controllers\Api\UserController;

/* ================= PUBLIC ================= */

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/status-lamaran', [UserController::class, 'getStatusLamaran']);
Route::get('/lowongan', [LowonganController::class, 'index']);
Route::get('/lowongan/{lowongan_id}', [LowonganController::class, 'show']);
Route::get('/keterampilan', [KeterampilanController::class, 'index']);

/* ================= AUTH USER ================= */

Route::middleware('auth:sanctum')->group(function () {

    // AUTH
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // PROFILE
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::put('/profile', [ProfileController::class, 'update']);
    Route::post('/profile/avatar', [ProfileController::class, 'uploadAvatar']);
    Route::post('/profile/cv', [ProfileController::class, 'uploadCv']);
    Route::get('/profile/skills', [ProfileController::class, 'getSkills']);

    // LAMARAN
    Route::get('/lamaran', [LamaranController::class, 'index']);
    Route::get('/lamaran/{id}', [LamaranController::class, 'show']);
    Route::post('/lamaran', [LamaranController::class, 'store']);

    Route::middleware('auth:sanctum')->group(function () {

    Route::post('/mobile/lamaran/step1', [LamaranController::class, 'mobileStep1']);
    Route::post('/mobile/lamaran/step2', [LamaranController::class, 'mobileStep2']);
    Route::post('/mobile/lamaran/step3', [LamaranController::class, 'mobileStep3']);

});

});

/* ================= HR ================= */

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/web/hr/lamaran', [LamaranController::class, 'hrIndex']);
    Route::put('/web/hr/lamaran/{id}/approve', [LamaranController::class, 'approve']);
    Route::delete('/web/hr/lamaran/{id}', [LamaranController::class, 'reject']);
});
