<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'nomor_po' => 'required',
            'supplier' => 'required',
            'material_id' => 'required|exists:materials,id',
            'jumlah_masuk' => 'required|numeric|min:1',
            'petugas' => 'required',
        ]);

        DB::transaction(function () use ($validated) {
            BarangMasuk::create($validated);
        });

        return redirect()->route('barang-masuk.index')->with('success', 'Barang Masuk berhasil dicatat.');
    }

    public function destroy(BarangMasuk $barangMasuk)
    {
        DB::transaction(function () use ($barangMasuk) {
            $barangMasuk->delete();
        });

        return redirect()->route('barang-masuk.index')->with('success', 'Barang Masuk berhasil dihapus.');
    }
}
