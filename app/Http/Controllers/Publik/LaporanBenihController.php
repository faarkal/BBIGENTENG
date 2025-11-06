<?php

namespace App\Http\Controllers\Publik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaporanBenih;

class LaporanBenihController extends Controller
{
    public function index(Request $request)
    {
        // Tahun & bulan dari request (default: tahun sekarang, semua bulan)
        $tahunSekarang = now()->year;
        $tahunDipilih = $request->input('tahun', $tahunSekarang);
        $bulanDipilih = $request->input('bulan');

        $query = LaporanBenih::query();

        // Filter berdasarkan tahun
        $query->whereYear('periode_pelaporan', $tahunDipilih);

        // Jika bulan juga diisi
        if (!empty($bulanDipilih)) {
            $query->whereMonth('periode_pelaporan', $bulanDipilih);
        }

        $laporan = $query->orderBy('periode_pelaporan', 'desc')->get();

        // Ambil daftar tahun unik dari database
        $daftarTahun = LaporanBenih::selectRaw('YEAR(periode_pelaporan) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        // Daftar bulan (1–12)
        $daftarBulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        return view('laporan_benih', compact(
            'laporan',
            'tahunDipilih',
            'bulanDipilih',
            'daftarTahun',
            'daftarBulan'
        ));
    }
}
