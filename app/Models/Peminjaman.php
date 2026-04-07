<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    
    protected $table = 'peminjaman';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detailPeminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class, 'peminjaman_id');
    }

    public function denda()
    {
        return $this->hasOne(Denda::class, 'peminjaman_id');
    }
}
