<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Material;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materials = [
            [
                'kode_material' => 'MAT-001',
                'nama_material' => 'Hand Glove Cotton PVC Dotted Black',
                'departemen' => 'Produksi',
                'lokasi_penyimpanan' => 'Gudang A',
                'stok' => 50,
                'lead_time' => 3,
                'periode' => 30,
            ],
            [
                'kode_material' => 'MAT-002',
                'nama_material' => 'Baterai 23A 12V LRV08',
                'departemen' => 'Maintenance',
                'lokasi_penyimpanan' => 'Gudang B',
                'stok' => 5,
                'lead_time' => 5,
                'periode' => 30,
            ],
            [
                'kode_material' => 'MAT-003',
                'nama_material' => 'VT620G Hitam',
                'departemen' => 'Produksi',
                'lokasi_penyimpanan' => 'Gudang A',
                'stok' => 100,
                'lead_time' => 7,
                'periode' => 30,
            ],
        ];

        foreach ($materials as $data) {
            $material = Material::create($data);
            $material->updateInventoryStatus();
        }
    }
}
