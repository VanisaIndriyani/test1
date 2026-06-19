<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    protected $fillable = [
        'tanggal',
        'nomor_po',
        'supplier',
        'material_id',
        'jumlah_masuk',
        'petugas',
    ];

    protected static function booted()
    {
        static::created(function ($barangMasuk) {
            $barangMasuk->material?->tambahStok($barangMasuk->jumlah_masuk);
        });

        static::deleted(function ($barangMasuk) {
            $barangMasuk->material?->kurangiStok($barangMasuk->jumlah_masuk);
        });
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
