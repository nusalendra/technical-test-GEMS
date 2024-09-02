<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Manager;
use App\Models\SuratPerintahLembur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengajuanLemburKaryawanController extends Controller
{
    public function index()
    {
        $data = SuratPerintahLembur::where('status', 'Menunggu Persetujuan')->get();
        return view('pages.manager.pengajuan-lembur-karyawan.index', compact('data'));
    }

    public function show($id)
    {
        $data = SuratPerintahLembur::find($id);
        $user = Auth::user();
        $manager = Manager::where('user_id', $user->id)->first();
        return view('pages.manager.pengajuan-lembur-karyawan.show', compact('data', 'user', 'manager'));
    }

    public function update($id, Request $request)
    {
        $status = $request->status;

        $data = SuratPerintahLembur::find($id);

        if ($data) {
            if ($status === 'Setuju') {
                $data->status = 'Setuju';

                $user = Auth::user();
                $manager = Manager::where('user_id', $user->id)->first();

                if ($manager) {
                    if ($request->hasFile('tanda_tangan')) {
                        if ($manager->url_tanda_tangan) {
                            Storage::disk('public')->delete($manager->url_tanda_tangan);
                        }
                        $file = $request->file('tanda_tangan');

                        $path = $file->store('tanda_tangan', 'public');

                        $manager->url_tanda_tangan = $path;
                        $manager->save();
                    }
                }
            } elseif ($status === 'Tolak') {
                $data->status = 'Tolak';
            }

            $data->save();

            return redirect('/pengajuan-lembur-karyawan')->with('success', 'Status pengajuan lembur karyawan berhasil diperbarui.');
        }

        return redirect('/pengajuan-lembur-karyawan')->with('error', 'Data permohonan lembur tidak ditemukan.');
    }
}
