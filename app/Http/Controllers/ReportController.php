<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function material()
    {
        $materials = Material::all();
        return view('reports.material', compact('materials'));
    }

    public function barangMasuk(Request $request)
    {
        $query = BarangMasuk::with('material');
        
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }

        $barangMasuks = $query->orderBy('tanggal', 'desc')->get();
        return view('reports.barang_masuk', compact('barangMasuks'));
    }

    public function barangKeluar(Request $request)
    {
        $query = BarangKeluar::with('material');
        
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }

        $barangKeluars = $query->orderBy('tanggal', 'desc')->get();
        return view('reports.barang_keluar', compact('barangKeluars'));
    }

    public function prioritas()
    {
        $materials = Material::orderByRaw("FIELD(status, 'Stock Out', 'Reorder/Kritis', 'Warning', 'Aman')")
            ->get();
        return view('reports.prioritas', compact('materials'));
    }
}
