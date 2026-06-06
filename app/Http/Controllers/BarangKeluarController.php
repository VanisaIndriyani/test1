<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\Material;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $barangKeluars = BarangKeluar::with('material')->orderBy('tanggal', 'desc')->get();
        return view('barang_keluar.index', compact('barangKeluars'));
    }

    public function create()
    {
        $materials = Material::where('stok', '>', 0)->get();
        return view('barang_keluar.create', compact('materials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'user_departemen' => 'required',
            'material_id' => 'required|exists:materials,id',
            'jumlah_keluar' => 'required|numeric|min:1',
            'keperluan' => 'required',
        ]);

        $material = Material::find($request->material_id);
        
        if ($material->stok < $request->jumlah_keluar) {
            return back()->withErrors(['jumlah_keluar' => 'Stok tidak mencukupi.'])->withInput();
        }

        $barangKeluar = BarangKeluar::create($request->all());

        // Update Stok
        $material->stok -= $request->jumlah_keluar;
        $material->save();
        $material->updateInventoryStatus();

        return redirect()->route('barang-keluar.index')->with('success', 'Barang Keluar berhasil dicatat.');
    }

    public function destroy(BarangKeluar $barangKeluar)
    {
        // Revert Stok
        $material = $barangKeluar->material;
        $material->stok += $barangKeluar->jumlah_keluar;
        $material->save();
        $material->updateInventoryStatus();

        $barangKeluar->delete();
        return redirect()->route('barang-keluar.index')->with('success', 'Barang Keluar berhasil dihapus.');
    }
}
