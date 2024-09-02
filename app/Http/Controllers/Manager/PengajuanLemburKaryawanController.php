<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Manager;
use App\Models\Notifikasi;
use App\Models\SuratPerintahLembur;
use Barryvdh\DomPDF\Facade\Pdf;
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

                $pdf = Pdf::loadView('pages.manager.pengajuan-lembur-karyawan.surat-perintah-lembur-pdf', ['data' => $data, 'user' => $user])
                    ->setPaper('a4', 'landscape');

                $randomInteger = rand(10000, 99990);
                $pdfFileName = $randomInteger . '_' . 'Surat_Perintah_Lembur_' . $data->karyawan->user->name . '_Tanggal Lembur ' . \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') . '.pdf';
                $pdfPath = 'surat_lembur/' . $pdfFileName;
                Storage::disk('public')->put($pdfPath, $pdf->output());

                $notifikasi = new Notifikasi();
                $notifikasi->user_id = $data->karyawan->user_id;
                $notifikasi->surat_perintah_lembur_id = $data->id;
                $notifikasi->pesan = 'Pengajuan lembur anda telah disetujui. Silakan unduh dokumen bukti persetujuan dalam format PDF, yang dapat Anda gunakan sebagai referensi resmi bahwa pengajuan lembur anda telah mendapatkan persetujuan.';
                $notifikasi->url_surat_perintah_lembur = $pdfPath;
                $notifikasi->save();
            } elseif ($status === 'Tolak') {
                $data->status = 'Tolak';

                $notifikasi = new Notifikasi();
                $notifikasi->user_id = $data->karyawan->user_id;
                $notifikasi->surat_perintah_lembur_id = $data->id;
                $notifikasi->pesan = 'Pengajuan lembur anda ditolak. Kami menyarankan anda untuk menghubungi Manajer terkait untuk mendapatkan klarifikasi lebih lanjut atau membahas langkah selanjutnya. Terima kasih atas pengertian anda.';
                $notifikasi->save();
            }

            $data->save();

            return redirect('/pengajuan-lembur-karyawan')->with('success', 'Status pengajuan lembur karyawan berhasil diperbarui.');
        }

        return redirect('/pengajuan-lembur-karyawan')->with('error', 'Data permohonan lembur tidak ditemukan.');
    }
}
