<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;
    protected $table = 'notifikasis';
    protected $primarykey = 'id';
    protected $fillable = ['user_id', 'surat_perintah_lembur_id', 'pesan', 'url_surat_perintah_lembur'];

    public function user() {
         return $this->belongsTo(User::class, 'user_id');
    }

    public function suratPerintahLembur() {
        return $this->belongsTo(SuratPerintahLembur::class, 'surat_perintah_lembur_id');
    }
}
