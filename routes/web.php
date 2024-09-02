<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Karyawan\NotifikasiController;
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
        Route::get('/posisi/create', [PosisiController::class, 'create'])->name('posisi.create');
        Route::post('/posisi', [PosisiController::class, 'store'])->name('posisi.store');
        Route::get('/posisi/{id}/edit', [PosisiController::class, 'edit'])->name('posisi.edit');
        Route::put('/posisi/{id}', [PosisiController::class, 'update'])->name('posisi.update');
        Route::delete('/posisi/{id}', [PosisiController::class, 'destroy'])->name('posisi.destroy');

        Route::get('/pengajuan-lembur-karyawan', [PengajuanLemburKaryawanController::class, 'index'])->name('pengajuan-lembur-karyawan.index');
        Route::get('/pengajuan-lembur-karyawan/{id}', [PengajuanLemburKaryawanController::class, 'show'])->name('pengajuan-lembur-karyawan.show');
        Route::put('/pengajuan-lembur-karyawan/{id}', [PengajuanLemburKaryawanController::class, 'update'])->name('pengajuan-lembur-karyawan.update');
        
        Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
        Route::get('/karyawan/create', [KaryawanController::class, 'create'])->name('karyawan.create');
        Route::post('/karyawan', [KaryawanController::class, 'store'])->name('karyawan.store');
        Route::get('/karyawan/{id}/edit', [KaryawanController::class, 'edit'])->name('karyawan.edit');
        Route::put('/karyawan/{id}', [KaryawanController::class, 'update'])->name('karyawan.update');
        Route::delete('/karyawan/{id}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');
    });

    Route::group(['middleware' => 'role:Karyawan'], function () {
        Route::get('/pengajuan-lembur', [PengajuanLemburController::class, 'index'])->name('pengajuan-lembur.index');
        Route::post('/pengajuan-lembur', [PengajuanLemburController::class, 'store'])->name('pengajuan-lembur.store');

        Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
        Route::get('/notifikasi/{id}', [NotifikasiController::class, 'show'])->name('notifikasi.show');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
