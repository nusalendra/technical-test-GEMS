<?php

namespace App\Http\Controllers\Manager;

use App\Charts\DurasiLemburByKaryawanChart;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Karyawan\PengajuanLemburController;
use Illuminate\Http\Request;
use App\Charts\PengajuanLemburByStatusChart;
use App\Charts\PengajuanLemburPerBulanChart;

class DashboardController extends Controller
{
    public function index(PengajuanLemburByStatusChart $pengajuanLemburByStatusChart, DurasiLemburByKaryawanChart $durasiLemburByKaryawanChart, PengajuanLemburPerBulanChart $pengajuanLemburPerBulanChart) {
        return view('pages.manager.dashboard.index', ['pengajuanLemburByStatusChart' => $pengajuanLemburByStatusChart->build(), 'durasiLemburByKaryawanChart' => $durasiLemburByKaryawanChart->build(), 'pengajuanLemburPerBulanChart' => $pengajuanLemburPerBulanChart->build()]);
    }
}
