<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProfilBalai;

class ProfilBalaiController extends Controller
{
    public function index()
    {
        $profil = ProfilBalai::first();
        return view('admin.profil-balai.index', compact('profil'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'deskripsi' => 'required',
        ]);

        ProfilBalai::updateOrCreate(
            ['id' => 1],
            ['deskripsi' => $request->deskripsi]
        );

        return redirect()->back()->with('success', 'Profil balai berhasil diperbarui!');
    }
}
