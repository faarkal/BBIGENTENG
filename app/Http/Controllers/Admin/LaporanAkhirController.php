<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterBenih;
use App\Models\Monitoring;
use Carbon\Carbon;

class LaporanAkhirController extends Controller
{
    public function index(Request $request)
    {
        // Ambil bulan & tahun terpisah dari query
        $bulanDipilih = $request->query('bulan', (int) Carbon::now()->format('m'));
        $tahunDipilih = $request->query('tahun', (int) Carbon::now()->format('Y'));

        // Validasi bulan (1-12) dan tahun
        if ($bulanDipilih < 1 || $bulanDipilih > 12) {
            $bulanDipilih = (int) Carbon::now()->format('m');
        }
        if ($tahunDipilih < 2020 || $tahunDipilih > (int) Carbon::now()->format('Y')) {
            $tahunDipilih = (int) Carbon::now()->format('Y');
        }

        // Buat rentang tanggal dari bulan & tahun
        try {
            $start = Carbon::createFromDate($tahunDipilih, $bulanDipilih, 1)->startOfMonth()->toDateString();
            $end = Carbon::createFromDate($tahunDipilih, $bulanDipilih, 1)->endOfMonth()->toDateString();
        } catch (\Exception $e) {
            $start = Carbon::now()->startOfMonth()->toDateString();
            $end = Carbon::now()->endOfMonth()->toDateString();
            $bulanDipilih = (int) Carbon::now()->format('m');
            $tahunDipilih = (int) Carbon::now()->format('Y');
        }

        // Daftar bulan (1-12)
        $bulanList = [
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
            12 => 'Desember',
        ];

        // Daftar tahun (10 tahun terakhir sampai sekarang)
        $tahunList = [];
        $tahunSekarang = (int) Carbon::now()->format('Y');
        for ($i = 0; $i < 10; $i++) {
            $t = $tahunSekarang - $i;
            $tahunList[$t] = $t;
        }
        $tahunList = array_reverse($tahunList, true);

        // Ambil semua MasterBenih
        $masterBenih = MasterBenih::orderBy('jenis_ikan')->get();

        // Ambil monitoring di rentang bulan & tahun
        $monitorings = Monitoring::whereBetween('tanggal', [$start, $end])
            ->orderBy('tanggal')
            ->get()
            ->groupBy('master_benih_id');

        // Siapkan koleksi produksi
        $produksi = $masterBenih->map(function ($item) use ($monitorings) {
            $mList = $monitorings->get($item->id, collect());

            // produksi bulan ini: jumlah bibit_awal dan ukuran referensi
            $produksi_jumlah = (int) $mList->sum('bibit_awal');
            $produksi_ukuran = $mList->last()->ukuran ?? $mList->first()->ukuran ?? null;

            // TERJUAL: ambil dari field terjual_jumlah dan terjual_ukuran jika ada
            $terjual_jumlah = (int) $mList->sum(function($m){ return $m->terjual_jumlah ?? 0; });
            $terjual_ukuran = $mList->whereNotNull('terjual_ukuran')->last()->terjual_ukuran ?? ($mList->last()->ukuran ?? null);
            $terjual_harga = (int) $mList->sum(function($m){ return $m->terjual_harga ?? 0; });

            // RESTOKING: ambil dari field restocking_jumlah dan restocking_ukuran jika ada
            $restock_jumlah = (int) $mList->sum(function($m){ return $m->restocking_jumlah ?? 0; });
            $restock_ukuran = $mList->whereNotNull('restocking_ukuran')->last()->restocking_ukuran ?? ($mList->last()->ukuran ?? null);

            // MATI: gunakan kematian_bibit sebagai jumlah, ambil ukurannya
            $mati_jumlah = (int) $mList->sum('kematian_bibit');
            $mati_ukuran = $mList->whereNotNull('ukuran')->last()->ukuran ?? null;

            // sisa bulan lalu
            $sisa_jumlah = (int) ($item->sisa_jumlah ?? 0);
            $sisa_ukuran = $item->sisa_ukuran ?? null;

            // jumlah total sebelum pengurangan
            $total_jumlah = $sisa_jumlah + $produksi_jumlah;

            // sisa akhir bulan ini = total + restock - terjual - mati
            $sisa_akhir_jumlah = $total_jumlah + $restock_jumlah - $terjual_jumlah - $mati_jumlah;
            $sisa_akhir_ukuran = $produksi_ukuran ?? $sisa_ukuran ?? null;

            // Pasang properti tambahan untuk view
            $item->monitoring = $mList;
            $item->produksi_jumlah = $produksi_jumlah;
            $item->produksi_ukuran = $produksi_ukuran;
            $item->total_jumlah = $total_jumlah;

            $item->terjual_jumlah = $terjual_jumlah;
            $item->terjual_ukuran = $terjual_ukuran;
            $item->terjual_harga = $terjual_harga;

            $item->restock_jumlah = $restock_jumlah;
            $item->restock_ukuran = $restock_ukuran;

            $item->mati_jumlah = $mati_jumlah;
            $item->mati_ukuran = $mati_ukuran;

            $item->sisa_jumlah = $sisa_jumlah;
            $item->sisa_ukuran = $sisa_ukuran;
            $item->sisa_akhir_jumlah = $sisa_akhir_jumlah;
            $item->sisa_akhir_ukuran = $sisa_akhir_ukuran;

            return $item;
        });

        return view('admin.laporan-akhir.index', [
            'produksi' => $produksi,
            'bulanList' => $bulanList,
            'tahunList' => $tahunList,
            'bulanDipilih' => $bulanDipilih,
            'tahunDipilih' => $tahunDipilih,
        ]);
    }
}
