<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VisiMisi;

class VisiMisiController extends Controller
{
    public function index()
    {
        $visiMisi = VisiMisi::first();
        return view('admin.visi-misi.index', compact('visiMisi'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'visi' => 'required',
            'misi' => 'required',
        ]);

        VisiMisi::updateOrCreate(
            ['id' => 1],
            [
                'visi' => $request->visi,
                'misi' => $request->misi,
            ]
        );

        return redirect()->back()->with('success', 'Visi & Misi berhasil diperbarui!');
    }
}
