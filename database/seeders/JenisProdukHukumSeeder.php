<?php

namespace Database\Seeders;

use App\Models\JenisProdukHukum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisProdukHukumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
        ['nama' => 'Peraturan Daerah', 'singkatan' => 'PERDA', 'kelompok' => 'Peraturan (Regeling)'],
        ['nama' => 'Peraturan Bupati', 'singkatan' => 'PERBUP', 'kelompok' => 'Peraturan (Regeling)'],
        ['nama' => 'Peraturan DPRD', 'singkatan' => 'PER-DPRD', 'kelompok' => 'Peraturan (Regeling)'],
        ['nama' => 'Keputusan Bupati', 'singkatan' => 'KEP', 'kelompok' => 'Keputusan (Beschikking)'],
        ['nama' => 'Keputusan DPRD', 'singkatan' => 'KEP-DPRD', 'kelompok' => 'Keputusan (Beschikking)'],
        ['nama' => 'Keputusan Sekretaris Daerah', 'singkatan' => 'KEP-SEKDA', 'kelompok' => 'Keputusan (Beschikking)'],
        ['nama' => 'Instruksi Bupati', 'singkatan' => 'INBUP', 'kelompok' => 'Lainnya'],
        ['nama' => 'Surat Edaran', 'singkatan' => 'SE', 'kelompok' => 'Lainnya'],
    ];

    foreach ($data as $item) {
        JenisProdukHukum::create($item);
    }
    }
}
