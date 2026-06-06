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

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
