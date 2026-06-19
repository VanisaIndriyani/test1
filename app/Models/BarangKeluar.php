<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    protected $fillable = [
        'tanggal',
        'user_departemen',
        'material_id',
        'jumlah_keluar',
        'keperluan',
    ];

    protected static function booted()
    {
        static::created(function ($barangKeluar) {
            $barangKeluar->material?->kurangiStok($barangKeluar->jumlah_keluar);
        });

        static::deleted(function ($barangKeluar) {
            $barangKeluar->material?->tambahStok($barangKeluar->jumlah_keluar);
        });
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
