<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Karyawan\PengajuanLemburController;
use App\Http\Controllers\Manager\KaryawanController;
use App\Http\Controllers\Manager\PengajuanLemburKaryawanController;
use App\Http\Controllers\Manager\PosisiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthenticatedSessionController::class, 'create']);

Route::middleware('auth')->group(function () {
    Route::group(['middleware' => 'role:Manager'], function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

        Route::get('/posisi', [PosisiController::class, 'index'])->name('posisi.index');
        Route::get('/pengajuan-lembur-karyawan', [PengajuanLemburKaryawanController::class, 'index'])->name('pengajuan-lembur-karyawan.index');
        Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
    });

    Route::group(['middleware' => 'role:Karyawan'], function () {
        Route::get('/pengajuan-lembur', [PengajuanLemburController::class, 'index'])->name('pengajuan-lembur.index');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
