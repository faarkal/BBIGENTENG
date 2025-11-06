<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    use HasFactory;

    protected $table = 'monitoring';

    protected $fillable = [
        'tanggal',
        'master_benih_id',
        'kolam',
        'bibit_awal',
        'ukuran',
        'kematian_bibit',
    ];

    public function masterBenih()
    {
        return $this->belongsTo(MasterBenih::class, 'master_benih_id');
    }
}
