<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Benih extends Model
{
    use HasFactory;

    protected $table = 'benihs'; // atau ubah ke 'benih' jika mau nama tunggal

    protected $fillable = [
        'jenis_benih',
        'bulan_menetas',
        'jumlah_benih',
        'ukuran_benih',
        'restocking',
        'kematian_benih',
        'harga_benih',
    ];

    protected static function booted()
    {
        static::saving(function ($benih) {
            $benih->jumlah_benih_akhir = $benih->jumlah_benih - ($benih->jumlah_benih * ($benih->kematian_benih / 100));
            $benih->total_harga_akhir = $benih->jumlah_benih_akhir * $benih->harga_benih;
        });
    }
}
