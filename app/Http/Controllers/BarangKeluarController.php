<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'user_departemen' => 'required',
            'material_id' => 'required|exists:materials,id',
            'jumlah_keluar' => 'required|numeric|min:1',
            'keperluan' => 'required',
        ]);

        $material = Material::find($request->material_id);
        
        if ($material->stok < $validated['jumlah_keluar']) {
            return back()->withErrors(['jumlah_keluar' => 'Stok tidak mencukupi.'])->withInput();
        }

        DB::transaction(function () use ($validated) {
            BarangKeluar::create($validated);
        });

        return redirect()->route('barang-keluar.index')->with('success', 'Barang Keluar berhasil dicatat.');
    }

    public function destroy(BarangKeluar $barangKeluar)
    {
        DB::transaction(function () use ($barangKeluar) {
            $barangKeluar->delete();
        });

        return redirect()->route('barang-keluar.index')->with('success', 'Barang Keluar berhasil dihapus.');
    }
}
