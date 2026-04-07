<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Buku extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'buku';
    protected $guarded = [];

    public function kategori()
    {
        return $this->belongsTo(KategoriBuku::class, 'kategori_id');
    }
}
