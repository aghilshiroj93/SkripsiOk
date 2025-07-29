<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MataPelajaran;

class MataPelajaranSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Matematika',
            'Bahasa Indonesia',
            'Bahasa Inggris',
            'IPA',
            'IPS',
            'PKN',
            'Seni Budaya',
            'Penjaskes',
        ];

        foreach ($data as $nama) {
            MataPelajaran::create(['nama' => $nama]);
        }
    }
}
