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
        $bulanDipilih = $request->query('bulan', Carbon::now()->format('Y-m'));

        try {
            $start = Carbon::createFromFormat('Y-m', $bulanDipilih)->startOfMonth()->toDateString();
            $end = Carbon::createFromFormat('Y-m', $bulanDipilih)->endOfMonth()->toDateString();
        } catch (\Exception $e) {
            $start = Carbon::now()->startOfMonth()->toDateString();
            $end = Carbon::now()->endOfMonth()->toDateString();
            $bulanDipilih = Carbon::now()->format('Y-m');
        }

        // daftar 12 bulan terakhir
        $bulanList = [];
        for ($i = 0; $i < 12; $i++) {
            $m = Carbon::now()->subMonths($i);
            $bulanList[$m->format('Y-m')] = $m->format('F Y');
        }
        $bulanList = array_reverse($bulanList, true);

        // Ambil semua MasterBenih
        $masterBenih = MasterBenih::orderBy('jenis_ikan')->get();

        // Ambil monitoring di rentang bulan dan group berdasarkan master_benih_id
        $monitorings = Monitoring::whereBetween('tanggal', [$start, $end])
            ->orderBy('tanggal')
            ->get()
            ->groupBy('master_benih_id');

        // Siapkan koleksi produksi: setiap MasterBenih diberi property monitoring (koleksi)
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
            'bulanDipilih' => $bulanDipilih,
        ]);
    }
}
