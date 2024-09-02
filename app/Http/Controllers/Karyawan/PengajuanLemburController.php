<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\SuratPerintahLembur;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PengajuanLemburController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $karyawan = Karyawan::where('user_id', $user->id)->first();
        return view('pages.karyawan.pengajuan-lembur.index', compact('user', 'karyawan'));
    }

    public function store(Request $request)
    {
        try {
            $rules = [
                'tanggal' => ['required', 'date'],
                'jam_mulai' => ['required', 'date_format:H:i'],
                'jam_selesai' => ['required', 'date_format:H:i', 'after:jam_mulai'],
                'pekerjaan' => ['required', 'string', 'max:255'],
            ];

            if (!$request->has('use_existing_signature')) {
                $rules['tanda_tangan'] = ['required', 'file', 'mimes:jpeg,png,jpg,gif', 'max:2048'];
            }

            $request->validate($rules);

            $jamMulai = \Carbon\Carbon::createFromFormat('H:i', $request->jam_mulai);
            $jamSelesai = \Carbon\Carbon::createFromFormat('H:i', $request->jam_selesai);
            $durasiMenit = $jamMulai->diffInMinutes($jamSelesai);

            $durasiJam = floor($durasiMenit / 60);
            $sisaMenit = $durasiMenit % 60;

            $durasi = $durasiJam . ' Jam';
            if ($sisaMenit > 0) {
                $durasi .= ' ' . $sisaMenit . ' Menit';
            }

            $user = Auth::user();

            $karyawan = Karyawan::where('user_id', $user->id)->first();

            if ($request->hasFile('tanda_tangan')) {
                if ($karyawan->url_tanda_tangan) {
                    Storage::disk('public')->delete($karyawan->url_tanda_tangan);
                }

                $file = $request->file('tanda_tangan');
                $path = $file->store('tanda_tangan', 'public');
                $karyawan->url_tanda_tangan = $path;
            }

            $karyawan->save();

            SuratPerintahLembur::create([
                'tanggal' => $request->tanggal,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'pekerjaan' => $request->pekerjaan,
                'durasi' => $durasi,
                'status' => 'Menunggu Persetujuan',
                'karyawan_id' => $karyawan->id,
            ]);

            return redirect('/pengajuan-lembur')->with('success', 'Pengajuan lembur berhasil diajukan.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->errors();
            return back()->withErrors($errors)->withInput()->with('error', 'Terjadi kesalahan pada input Anda!');
        } catch (\Exception $e) {
            return back()->with('error', 'Data pengajuan lembur gagal ditambahkan! ' . $e->getMessage())->withInput();
        }
    }
}
