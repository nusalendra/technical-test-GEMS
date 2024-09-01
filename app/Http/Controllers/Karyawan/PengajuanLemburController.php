<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengajuanLemburController extends Controller
{
    public function index() {
        return view('pages.karyawan.pengajuan-lembur.index');
    }
}
