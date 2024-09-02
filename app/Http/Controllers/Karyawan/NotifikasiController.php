<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function index() {
        $user = Auth::user();
        $data = Notifikasi::where('user_id', $user->id)->get();
        return view('pages.karyawan.notifikasi.index', compact('data'));
    }

    public function show($id) {
        $data = Notifikasi::find($id);
        return view('pages.karyawan.notifikasi.show', compact('data'));
    }
}
