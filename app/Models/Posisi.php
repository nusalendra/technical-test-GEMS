<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posisi extends Model
{
    use HasFactory;
    protected $table = 'posisis';
    protected $primarykey = 'id';
    protected $fillable = ['nama'];

    public function karyawan() {
        return $this->hasMany(Karyawan::class, 'posisi_id');
    }
}
