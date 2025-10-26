<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterBenih;
use Illuminate\Http\Request;

class MasterBenihController extends Controller
{
    public function index()
    {
        $masterBenih = MasterBenih::all();
        return view('admin.master_benih.index', compact('masterBenih'));
    }

    public function create()
    {
        return view('admin.master_benih.form', ['masterBenih' => new MasterBenih()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_ikan' => 'required|string|max:255',
            'jumlah_benih' => 'required|integer|min:0',
            'ukuran' => 'nullable|numeric|min:0',
            'restocking' => 'nullable|integer|min:0',
            'harga_perekor' => 'nullable|numeric|min:0',
            'kematian_benih' => 'nullable|numeric|min:0|max:100',
        ]);

        MasterBenih::create($request->all());
        return redirect()->route('admin.master-benih.index')->with('success', 'Data master benih berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $masterBenih = MasterBenih::findOrFail($id);
        return view('admin.master_benih.form', compact('masterBenih'));
    }

    public function update(Request $request, $id)
    {
        $masterBenih = MasterBenih::findOrFail($id);

        $request->validate([
            'jenis_ikan' => 'required|string|max:255',
            'jumlah_benih' => 'required|integer|min:0',
            'ukuran' => 'nullable|numeric|min:0',
            'restocking' => 'nullable|integer|min:0',
            'harga_perekor' => 'nullable|numeric|min:0',
            'kematian_benih' => 'nullable|numeric|min:0|max:100',
        ]);

        $masterBenih->update($request->all());
        return redirect()->route('admin.master-benih.index')->with('success', 'Data master benih berhasil diperbarui.');
    }

    public function destroy($id)
    {
        MasterBenih::findOrFail($id)->delete();
        return redirect()->route('admin.master-benih.index')->with('success', 'Data master benih berhasil dihapus.');
    }
}
