<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Benih;

class PemesananAdminController extends Controller
{
        public function index()
    {
        $pemesanan = Pemesanan::orderBy('created_at', 'desc')->get();
        return view('admin.pemesanan.index', compact('pemesanan'));
    }

    public function konfirmasi($id)
    {
        $p = Pemesanan::findOrFail($id);
        $p->update(['status' => 'Diterima']);

        // 🔹 Tambahkan ke tabel benih
        Benih::create([
            'jenis_benih' => $p->jenis_bibit,
            'bulan_menetas' => now(),
            'jumlah_benih' => $p->jumlah_ikan,
            'ukuran_benih' => 0,
            'restocking' => 0,
            'kematian_benih' => 0,
            'harga_benih' => $p->total_harga / $p->jumlah_ikan,
            'jumlah_benih_akhir' => $p->jumlah_ikan,
            'total_harga_akhir' => $p->total_harga,
        ]);

        return redirect()->back()->with('success', 'Pesanan berhasil dikonfirmasi dan dimasukkan ke data benih!');
    }

    public function tolak($id)
    {
        $p = Pemesanan::findOrFail($id);
        $p->update(['status' => 'Ditolak']);

        return redirect()->back()->with('success', 'Pesanan telah ditolak.');
}
}
