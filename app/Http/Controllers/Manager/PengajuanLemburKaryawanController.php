<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengajuanLemburKaryawanController extends Controller
{
    public function index() {
        return view('pages.manager.pengajuan-lembur-karyawan.index');
    }
}
