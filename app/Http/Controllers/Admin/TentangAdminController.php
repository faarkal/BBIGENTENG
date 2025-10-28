<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sejarah;

class TentangAdminController extends Controller
{
    public function sejarah()
    {
        $sejarah = Sejarah::first(); // ambil record pertama jika ada
        return view('admin.tentang.sejarah', compact('sejarah'));
    }

    // update data dari form admin
    public function updateSejarah(Request $request)
    {
        $data = $request->validate([
            'judul' => 'nullable|string|max:255',
            'isi'   => 'required|string',
        ]);

        $sejarah = Sejarah::first();
        if (!$sejarah) {
            // buat baru jika belum ada
            Sejarah::create([
                'judul' => $data['judul'] ?? null,
                'isi' => $data['isi'],
            ]);
        } else {
            $sejarah->update([
                'judul' => $data['judul'] ?? $sejarah->judul,
                'isi' => $data['isi'],
            ]);
        }

        return redirect()->route('admin.sejarah')->with('success', 'Sejarah berhasil diperbarui.');
    }
}
