<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\MasterBenih;

class PemesananController extends Controller
{
    public function index()
    {
        // Ambil data master benih untuk mengisi pilihan jenis ikan
        $masterBenih = MasterBenih::orderBy('jenis_ikan')->get();
        return view('pemesanan', compact('masterBenih'));
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
            'Nila Gift' => 100,
            'Nila Hitam' => 1500,
            'Gurame' => 2500,
            'Tombro' => 3000,
            'Koi' => 500,
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
        $nomorWA = "6285648723506";

        // Simpan pemesanan ke database
        Pemesanan::create([
            'jenis_bibit' => $jenis,
            'nama_pemesan' => $request->nama_pemesan,
            'no_Telpon' => $request->no_Telpon,
            'jumlah_ikan' => $jumlah,
            'total_harga' => $hargaTotal,
            'status' => 'pending',
        ]);

        // Redirect ke WhatsApp
        $url = "https://wa.me/{$nomorWA}?text=" . urlencode($pesan);
        return redirect()->away($url);
    }
}
