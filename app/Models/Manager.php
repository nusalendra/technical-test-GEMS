<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use HasFactory;
    protected $table = 'managers';
    protected $primarykey = 'id';
    protected $fillable = ['url_tanda_tangan', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
