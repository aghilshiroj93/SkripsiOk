<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        $data = ['IPA', 'IPS', 'Bahasa', 'Teknik Komputer', 'Akuntansi'];

        foreach ($data as $nama) {
            Jurusan::create(['nama' => $nama]);
        }
    }
}
