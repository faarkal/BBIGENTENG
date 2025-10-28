<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanan';

    protected $fillable = [
        'jenis_bibit',
        'nama_pemesan',
        'no_Telpon',
        'jumlah_ikan',
        'total_harga',
        'status',
    ];
}
