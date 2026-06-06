<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'kode_material',
        'nama_material',
        'departemen',
        'lokasi_penyimpanan',
        'stok',
        'lead_time',
        'periode',
        'usage_rate',
        'safety_stock',
        'rop',
        'status',
    ];

    public function barangMasuks()
    {
        return $this->hasMany(BarangMasuk::class);
    }

    public function barangKeluars()
    {
        return $this->hasMany(BarangKeluar::class);
    }

    public function updateInventoryStatus()
    {
        // Usage Rate = Total Keluar / Periode
        $totalKeluar = $this->barangKeluars()->sum('jumlah_keluar');
        $this->usage_rate = $this->periode > 0 ? $totalKeluar / $this->periode : 0;

        // Safety Stock = 50% x Usage Rate
        $this->safety_stock = 0.5 * $this->usage_rate;

        // ROP = (Usage Rate x Lead Time) + Safety Stock
        $this->rop = ($this->usage_rate * $this->lead_time) + $this->safety_stock;

        // Status Logic
        if ($this->stok <= 0) {
            $this->status = 'Stock Out';
        } elseif ($this->stok <= $this->safety_stock) {
            $this->status = 'Reorder/Kritis';
        } elseif ($this->stok <= $this->rop) {
            $this->status = 'Warning';
        } else {
            $this->status = 'Aman';
        }

        $this->save();
    }
}
