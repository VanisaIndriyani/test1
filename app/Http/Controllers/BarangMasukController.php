<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Material;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index()
    {
        $barangMasuks = BarangMasuk::with('material')->orderBy('tanggal', 'desc')->get();
        return view('barang_masuk.index', compact('barangMasuks'));
    }

    public function create()
    {
        $materials = Material::all();
        return view('barang_masuk.create', compact('materials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'nomor_po' => 'required',
            'supplier' => 'required',
            'material_id' => 'required|exists:materials,id',
            'jumlah_masuk' => 'required|numeric|min:1',
            'petugas' => 'required',
        ]);

        $barangMasuk = BarangMasuk::create($request->all());

        // Update Stok
        $material = Material::find($request->material_id);
        $material->stok += $request->jumlah_masuk;
        $material->save();
        $material->updateInventoryStatus();

        return redirect()->route('barang-masuk.index')->with('success', 'Barang Masuk berhasil dicatat.');
    }

    public function destroy(BarangMasuk $barangMasuk)
    {
        // Revert Stok
        $material = $barangMasuk->material;
        $material->stok -= $barangMasuk->jumlah_masuk;
        $material->save();
        $material->updateInventoryStatus();

        $barangMasuk->delete();
        return redirect()->route('barang-masuk.index')->with('success', 'Barang Masuk berhasil dihapus.');
    }
}
