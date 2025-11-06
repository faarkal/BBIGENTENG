<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LaporanInduk extends Model
{
    use HasFactory;

    protected $table = 'laporan_induk';

    protected $fillable = [
        'nama_file',
        'file_path',
        'periode_pelaporan',
    ];

    protected $casts = [
        'periode_pelaporan' => 'datetime',
    ];
}
