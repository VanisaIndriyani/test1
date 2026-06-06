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

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
