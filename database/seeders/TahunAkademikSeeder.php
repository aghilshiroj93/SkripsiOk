<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TahunAkademik;

class TahunAkademikSeeder extends Seeder
{
    public function run(): void
    {
        TahunAkademik::create([
            'tahun' => '2024/2025',
            'semester' => 'ganjil',
            'is_active' => true,
        ]);

        TahunAkademik::create([
            'tahun' => '2024/2025',
            'semester' => 'genap',
            'is_active' => false,
        ]);
    }
}
