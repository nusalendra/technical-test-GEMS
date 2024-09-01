<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPerintahLembur extends Model
{
    use HasFactory;
    protected $table = 'surat_perintah_lemburs';
    protected $primarykey = 'id';
    protected $fillable = ['user_id', 'posisi_id', 'tanggal', 'jam_mulai', 'jam_selesai', 'durasi', 'status'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function posisi() {
        return $this->belongsTo(Posisi::class, 'posisi_id');
    }
}
