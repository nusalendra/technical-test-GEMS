<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPerintahLembur extends Model
{
    use HasFactory;
    protected $table = 'surat_perintah_lemburs';
    protected $primarykey = 'id';
    protected $fillable = ['tanggal', 'jam_mulai', 'jam_selesai', 'durasi', 'status', 'pekerjaan', 'karyawan_id'];

    public function karyawan() {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }

    public function notifikasi() {
        return $this->hasOne(Notifikasi::class, 'surat_perintah_lembur_id');
    }
}
