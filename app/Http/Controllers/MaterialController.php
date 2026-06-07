<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::all();
        return view('material.index', compact('materials'));
    }

    public function create()
    {
        return view('material.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_material' => 'required|unique:materials',
            'nama_material' => 'required',
            'stok' => 'required|numeric',
            'lead_time' => 'required|numeric',
            'periode' => 'required|numeric',
            'usage_rate' => 'required|numeric',
            'safety_stock' => 'required|numeric',
        ]);

        $material = Material::create($request->all());
        $material->updateInventoryStatus();

        return redirect()->route('material.index')->with('success', 'Material berhasil ditambahkan.');
    }

    public function edit(Material $material)
    {
        return view('material.edit', compact('material'));
    }

    public function update(Request $request, Material $material)
    {
        $request->validate([
            'kode_material' => 'required|unique:materials,kode_material,' . $material->id,
            'nama_material' => 'required',
            'stok' => 'required|numeric',
            'lead_time' => 'required|numeric',
            'periode' => 'required|numeric',
            'usage_rate' => 'required|numeric',
            'safety_stock' => 'required|numeric',
        ]);

        $material->update($request->all());
        $material->updateInventoryStatus();

        return redirect()->route('material.index')->with('success', 'Material berhasil diupdate.');
    }

    public function destroy(Material $material)
    {
        $material->delete();
        return redirect()->route('material.index')->with('success', 'Material berhasil dihapus.');
    }

    public function monitoring()
    {
        $materials = Material::all();
        return view('material.monitoring', compact('materials'));
    }

    public function prioritas()
    {
        $materials = Material::orderByRaw("FIELD(status, 'Stock Out', 'Reorder/Kritis', 'Warning', 'Aman')")
            ->get();
        return view('material.prioritas', compact('materials'));
    }
}
