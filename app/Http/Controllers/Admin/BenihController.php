<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Benih;
use App\Models\MasterBenih;

class BenihController extends Controller
{
    public function index()
    {
        $benih = Benih::orderBy('created_at', 'desc')->get();
        return view('admin.benih.index', compact('benih'));
    }

    public function create()
    {
        $benih = new Benih();
        $masterBenih = \App\Models\MasterBenih::all(); // 🔹 ambil semua jenis ikan dari master
        return view('admin.benih.form', compact('benih', 'masterBenih'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_benih' => 'required|string|max:255',
            'bulan_menetas' => 'required|date',
            'jumlah_benih' => 'required|integer|min:0',
            'ukuran_benih' => 'nullable|numeric|min:0',
            'restocking' => 'nullable|integer|min:0',
            'kematian_benih' => 'nullable|numeric|min:0|max:100',
            'harga_benih' => 'required|numeric|min:0',
        ]);

        // 🧮 Perhitungan otomatis
        $jumlah_benih = $request->jumlah_benih;
        $kematian = $request->kematian_benih ?? 0;
        $harga = $request->harga_benih;

        $jumlah_akhir = $jumlah_benih - ($jumlah_benih * ($kematian / 100));
        $total_harga = $jumlah_akhir * $harga;

        Benih::create([
            'jenis_benih' => $request->jenis_benih,
            'bulan_menetas' => $request->bulan_menetas,
            'jumlah_benih' => $jumlah_benih,
            'ukuran_benih' => $request->ukuran_benih,
            'restocking' => $request->restocking ?? 0,
            'kematian_benih' => $kematian,
            'harga_benih' => $harga,
            'jumlah_benih_akhir' => $jumlah_akhir,
            'total_harga_akhir' => $total_harga,
        ]);

        return redirect()->route('admin.benih.index')->with('success', 'Data benih berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_benih' => 'required|string|max:255',
            'bulan_menetas' => 'required|date',
            'jumlah_benih' => 'required|integer|min:0',
            'ukuran_benih' => 'nullable|numeric|min:0',
            'restocking' => 'nullable|integer|min:0',
            'kematian_benih' => 'nullable|numeric|min:0|max:100',
            'harga_benih' => 'required|numeric|min:0',
        ]);

        $benih = Benih::findOrFail($id);

        // 🧮 Perhitungan otomatis
        $jumlah_benih = $request->jumlah_benih;
        $kematian = $request->kematian_benih ?? 0;
        $harga = $request->harga_benih;

        $jumlah_akhir = $jumlah_benih - ($jumlah_benih * ($kematian / 100));
        $total_harga = $jumlah_akhir * $harga;

        $benih->update([
            'jenis_benih' => $request->jenis_benih,
            'bulan_menetas' => $request->bulan_menetas,
            'jumlah_benih' => $jumlah_benih,
            'ukuran_benih' => $request->ukuran_benih,
            'restocking' => $request->restocking ?? 0,
            'kematian_benih' => $kematian,
            'harga_benih' => $harga,
            'jumlah_benih_akhir' => $jumlah_akhir,
            'total_harga_akhir' => $total_harga,
        ]);

        return redirect()->route('admin.benih.index')->with('success', 'Data benih berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $benih = Benih::findOrFail($id);
        $benih->delete();

        return redirect()->route('admin.benih.index')->with('success', 'Data benih berhasil dihapus!');
    }
}
