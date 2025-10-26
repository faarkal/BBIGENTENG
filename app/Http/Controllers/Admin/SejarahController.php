<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sejarah;

class SejarahController extends Controller
{
    public function index()
    {
        $sejarah = Sejarah::first(); // ambil data pertama
        return view('admin.sejarah.index', compact('sejarah'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'isi' => 'required',
        ]);

        Sejarah::updateOrCreate(
            ['id' => 1], // hanya 1 baris sejarah
            [
                'judul' => 'Sejarah Balai Usaha Perikanan Genteng',
                'isi' => $request->isi, // pastikan nama kolom = isi
            ]
        );

        return redirect()->back()->with('success', 'Sejarah berhasil diperbarui!');
    }
}
