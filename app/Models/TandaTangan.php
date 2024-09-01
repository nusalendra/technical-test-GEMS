<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TandaTangan extends Model
{
    use HasFactory;
    protected $table = 'tanda_tangans';
    protected $primarykey = 'id';
    protected $fillable = ['user_id', 'url'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
