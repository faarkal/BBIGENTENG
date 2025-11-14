<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaporanBenih;
use Illuminate\Support\Facades\Storage;

class LaporanBenihController extends Controller
{
    // 🔹 Halaman Admin
    public function index(Request $request)

    {
        $query = LaporanBenih::query();

        // 🔹 Filter berdasarkan tahun (default: tahun sekarang)
        $tahun = $request->filled('tahun') ? $request->tahun : now()->year;
        $query->whereYear('periode_pelaporan', $tahun);

        // 🔹 Filter berdasarkan bulan jika dipilih
        if ($request->filled('bulan')) {
            $query->whereMonth('periode_pelaporan', $request->bulan);
        }

        // 🔹 Ambil data laporan
        $laporan = $query->orderBy('periode_pelaporan', 'desc')->get();

        // 🔹 Data tambahan untuk dropdown filter
        $daftarTahun = LaporanBenih::selectRaw('YEAR(periode_pelaporan) as tahun')
            ->distinct()
            ->orderByDesc('tahun')
            ->pluck('tahun');

        return view('admin.laporan_benih.index', compact('laporan', 'daftarTahun', 'tahun'));
    }

    // 🔹 Halaman Publik
    public function publicIndex(Request $request)
    {
        $query = LaporanBenih::query();

        if ($request->filled('bulan')) {
            $query->whereMonth('periode_pelaporan', date('m', strtotime($request->bulan)))
                ->whereYear('periode_pelaporan', date('Y', strtotime($request->bulan)));
        }

        $laporan = $query->orderBy('periode_pelaporan', 'desc')->get();

        return view('laporan_benih', compact('laporan'));
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
        $file->storeAs('public/laporan_benih', $fileName);

        LaporanBenih::create([
            'nama_file' => $request->nama_file,
            'file_path' => 'laporan_benih/' . $fileName,
            'periode_pelaporan' => $request->periode_pelaporan,
        ]);

        return back()->with('success', 'Laporan berhasil diunggah!');
    }

    // 🔹 Hapus Laporan
    public function destroy($id)
    {
        $laporan = LaporanBenih::findOrFail($id);

        if (Storage::disk('public')->exists($laporan->file_path)) {
            Storage::disk('public')->delete($laporan->file_path);
        }

        $laporan->delete();

        return back()->with('success', 'Laporan berhasil dihapus.');
    }
}
