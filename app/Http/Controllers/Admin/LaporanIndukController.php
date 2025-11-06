<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaporanInduk;
use Illuminate\Support\Facades\Storage;

class LaporanIndukController extends Controller
{
    // 🔹 Halaman Admin
    public function index(Request $request)
    {
        $query = LaporanInduk::query();

        $tahun = $request->filled('tahun') ? $request->tahun : now()->year;
        $query->whereYear('periode_pelaporan', $tahun);

        if ($request->filled('bulan')) {
            $query->whereMonth('periode_pelaporan', $request->bulan);
        }

        $laporan = $query->orderBy('periode_pelaporan', 'desc')->get();

        $daftarTahun = LaporanInduk::selectRaw('YEAR(periode_pelaporan) as tahun')
            ->distinct()
            ->orderByDesc('tahun')
            ->pluck('tahun');

        return view('admin.laporan_induk.index', compact('laporan', 'daftarTahun', 'tahun'));
    }

    // 🔹 Upload Laporan
    public function store(Request $request)
    {
        $request->validate([
            'nama_file' => 'required|string|max:255',
            'file_path' => 'required|file|mimes:pdf,doc,docx,xlsx,xls|max:2048',
            'periode_pelaporan' => 'required|date',
        ]);

        $file = $request->file('file_path');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/laporan_induk', $fileName);

        LaporanInduk::create([
            'nama_file' => $request->nama_file,
            'file_path' => 'laporan_induk/' . $fileName,
            'periode_pelaporan' => $request->periode_pelaporan,
        ]);

        return back()->with('success', 'Laporan Induk berhasil diunggah!');
    }

    // 🔹 Hapus Laporan
    public function destroy($id)
    {
        $laporan = LaporanInduk::findOrFail($id);

        if (Storage::disk('public')->exists($laporan->file_path)) {
            Storage::disk('public')->delete($laporan->file_path);
        }

        $laporan->delete();

        return back()->with('success', 'Laporan Induk berhasil dihapus.');
    }
}
