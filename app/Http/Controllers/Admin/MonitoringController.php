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

// ...existing code...
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

        // Simpan dan ambil ID dari record yang baru dibuat
        $monitoring = Monitoring::create($data);

        return redirect()->route('admin.monitoring.monitoring', $monitoring->id)
            ->with('success', 'Data monitoring berhasil disimpan!');
    }
// ...existing code...

    /**
     * Tampilkan form monitoring mingguan + hasil monitoring
     */
    public function monitoring(Request $request, $id)
{
    $monitoring = Monitoring::findOrFail($id);
    $jenisIkan = MasterBenih::select('id', 'jenis_ikan')
        ->orderBy('jenis_ikan', 'asc')
        ->get();

    $month = $request->query('month');
    $query = Monitoring::where('master_benih_id', $monitoring->master_benih_id);

    if ($month) {
        try {
            $c = Carbon::createFromFormat('Y-m', $month);
            $query->whereYear('tanggal', $c->year)
                  ->whereMonth('tanggal', $c->month);
        } catch (\Exception $e) {
            // Abaikan filter jika format tanggal salah
        }
    } else {
        $c = Carbon::parse($monitoring->tanggal);
        $query->whereYear('tanggal', $c->year)
              ->whereMonth('tanggal', $c->month);
        $month = $c->format('Y-m');
    }

    $mingguan = $query->orderBy('tanggal', 'asc')->get();

    // Perhitungan kumulatif jumlah akhir
    $jumlah_awal = null;
    foreach ($mingguan as $idx => $m) {
        if ($idx === 0) {
            $jumlah_awal = $m->bibit_awal;
        } else {
            $jumlah_awal = $mingguan[$idx-1]->jumlah_akhir;
        }
        $m->jumlah_akhir = $jumlah_awal - ($m->kematian_bibit ?? 0);
    }

    return view('admin.monitoring.monitoring', [
        'monitoring' => $monitoring,
        'jenisIkan' => $jenisIkan,
        'mingguan' => $mingguan,
        'selectedMonth' => $month,
    ]);
}


    /**
     * Simpan perubahan data monitoring (edit record yang ada)
     */
   public function update(Request $request, $id)
{
    $data = $request->validate([
        'tanggal' => 'required|date',
        'master_benih_id' => 'required|exists:master_benihs,id',
        'kolam' => 'required|string|max:255',
        'bibit_awal' => 'required|integer|min:0',
        'ukuran' => 'nullable|string|max:50',
        'kematian_bibit' => 'nullable|integer|min:0',
    ]);

    $monitoring = Monitoring::findOrFail($id);

    $data['jumlah_akhir'] = ($data['bibit_awal'] ?? 0) - ($data['kematian_bibit'] ?? 0);

    $monitoring->update($data);

    return redirect()->route('admin.monitoring.monitoring', $monitoring->id)
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

