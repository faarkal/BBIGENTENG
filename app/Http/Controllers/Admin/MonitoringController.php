<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Monitoring;
use App\Models\MasterBenih;
use Carbon\Carbon;

class MonitoringController extends Controller
{
    /**
     * Tampilkan daftar data monitoring
     */
    public function index()
    {
        $monitorings = Monitoring::with('masterBenih')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('admin.monitoring.index', compact('monitorings'));
    }

    /**
     * Form tambah data monitoring
     */
    public function create()
    {
        $jenisIkan = MasterBenih::select('id', 'jenis_ikan')
            ->orderBy('jenis_ikan', 'asc')
            ->get();

        return view('admin.monitoring.create', compact('jenisIkan'));
    }

    /**
     * Simpan data monitoring baru
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'tanggal' => 'nullable|date',
            'master_benih_id' => 'required|exists:master_benihs,id',
            'kolam' => 'required|string|max:100',
            'bibit_awal' => 'required|integer|min:0',
        ]);

        // Jika tanggal kosong, isi otomatis hari ini
        $data['tanggal'] = $data['tanggal'] ?? now()->toDateString();

        Monitoring::create($data);

        return redirect()->route('admin.monitoring.index')
            ->with('success', 'Data monitoring berhasil disimpan!');
    }

    /**
     * Tampilkan form monitoring mingguan + hasil monitoring
     */
    public function monitoring($id)
{
    $monitoring = Monitoring::findOrFail($id);
    $jenisIkan = MasterBenih::select('id', 'jenis_ikan')
        ->orderBy('jenis_ikan', 'asc')
        ->get();

    // 🔹 Ambil semua hasil monitoring berdasarkan kolam yang sama
    $mingguan = Monitoring::where('kolam', $monitoring->kolam)
        ->orderBy('tanggal', 'desc')
        ->get();

    return view('admin.monitoring.monitoring', compact('monitoring', 'jenisIkan', 'mingguan'));
}

public function update(Request $request, $id)
{
    $monitoring = Monitoring::findOrFail($id);

    $data = $request->validate([
        'tanggal' => 'required|date',
        'master_benih_id' => 'required|exists:master_benihs,id',
        'kolam' => 'required|string|max:255',
        'bibit_awal' => 'required|integer|min:0',
        'ukuran' => 'nullable|string|max:50',
        'kematian_bibit' => 'nullable|integer|min:0',
    ]);

    $monitoring->update($data);
    $monitoring->refresh();

    $jenisIkan = MasterBenih::select('id', 'jenis_ikan')
        ->orderBy('jenis_ikan', 'asc')
        ->get();

    // 🔹 Ambil semua hasil monitoring berdasarkan kolam yang sama
    $mingguan = Monitoring::where('kolam', $monitoring->kolam)
        ->orderBy('tanggal', 'desc')
        ->get();

    return view('admin.monitoring.monitoring', compact('monitoring', 'jenisIkan', 'mingguan'))
        ->with('success', 'Data monitoring berhasil diperbarui!');
}


    /**
     * Hapus data monitoring
     */
    public function destroy($id)
    {
        $monitoring = Monitoring::findOrFail($id);
        $monitoring->delete();

        return redirect()->route('admin.monitoring.index')
            ->with('success', 'Data monitoring berhasil dihapus!');
    }
}
