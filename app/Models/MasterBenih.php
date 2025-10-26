<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterBenih extends Model
{
     use HasFactory;

    protected $fillable = [
        'jenis_ikan',
        'jumlah_benih',
        'ukuran',
        'restocking',
        'harga_perekor',
        'kematian_benih',
    ];
}
