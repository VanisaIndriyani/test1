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

    public function tambahStok($jumlah)
    {
        $this->stok += $jumlah;
        $this->save();
        $this->updateInventoryStatus();
    }

    public function kurangiStok($jumlah)
    {
        $this->stok -= $jumlah;
        $this->save();
        $this->updateInventoryStatus();
    }

    public function updateInventoryStatus()
    {
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
