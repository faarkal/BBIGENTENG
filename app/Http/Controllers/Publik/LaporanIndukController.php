<?php

namespace App\Http\Controllers\Publik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaporanInduk;
use Illuminate\Support\Facades\Storage;

class LaporanIndukController extends Controller
{
    public function index(Request $request)
    {
        $tahunSekarang = now()->year;
        $tahunDipilih = $request->input('tahun', $tahunSekarang);
        $bulanDipilih = $request->input('bulan');

        $query = LaporanInduk::query();
        $query->whereYear('periode_pelaporan', $tahunDipilih);

        if (!empty($bulanDipilih)) {
            $query->whereMonth('periode_pelaporan', $bulanDipilih);
        }

        $laporan = $query->orderBy('periode_pelaporan', 'desc')->get();

        $daftarTahun = LaporanInduk::selectRaw('YEAR(periode_pelaporan) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        $daftarBulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        return view('laporan_induk', compact(
            'laporan',
            'tahunDipilih',
            'bulanDipilih',
            'daftarTahun',
            'daftarBulan',
            'tahunSekarang'
        ));
    }
}
