<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PemesananController extends Controller
{
    public function index()
    {
        // Menampilkan view pemesanan.blade.php
        return view('pemesanan');
    }

    /**
     * Menangani pengiriman form pemesanan.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'jenis_bibit' => 'required|string',
            'nama_pemesan' => 'required|string|max:100',
            'no_Telpon' => 'required|string|max:20',
            'jumlah_ikan' => 'required|integer|min:1',
        ]);

        // Simulasi perhitungan harga (jika tidak dihitung di frontend)
        $hargaIkan = [
            'Nila Gift' => 15000,
            'Nila Hitam' => 12000,
            'Gurame' => 25000,
            'Tombro' => 18000,
            'Koi' => 50000,
        ];

        $jenis = $request->jenis_bibit;
        $jumlah = $request->jumlah_ikan;
        $hargaTotal = isset($hargaIkan[$jenis]) ? $hargaIkan[$jenis] * $jumlah : 0;

        // Format pesan WhatsApp
        $pesan = "Halo, saya ingin memesan ikan:\n\n"
            . "👤 Nama: {$request->nama_pemesan}\n"
            . "📞 No. Telp: {$request->no_Telpon}\n"
            . "🐟 Jenis Ikan: {$jenis}\n"
            . "🔢 Jumlah: {$jumlah}\n"
            . "💰 Total Harga: Rp " . number_format($hargaTotal, 0, ',', '.') . "\n\n"
            . "Mohon konfirmasinya.";

        // Nomor tujuan WhatsApp (ganti sesuai nomor balai)
        $nomorWA = "6285935044462";

        // Redirect ke WhatsApp
        $url = "https://wa.me/{$nomorWA}?text=" . urlencode($pesan);
        return redirect()->away($url);
    }
}
