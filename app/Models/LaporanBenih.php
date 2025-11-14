<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LaporanBenih extends Model
{
    use HasFactory;

    protected $table = 'laporan_benih';

    protected $fillable = [
        'nama_file',
        'file_path',
        'periode_pelaporan',
    ];

    protected $casts = [
        'periode_pelaporan' => 'datetime',
    ];
}
