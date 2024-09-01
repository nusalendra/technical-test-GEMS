<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $table = 'karyawans';
    protected $primarykey = 'id';
    protected $fillable = ['url_tanda_tangan', 'user_id', 'posisi_id'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function posisi() {
        return $this->belongsTo(Posisi::class, 'posisi_id');
    }

    public function suratPerintahLembur() {
        return $this->hasMany(SuratPerintahLembur::class, 'karyawan_id');
    }
}
