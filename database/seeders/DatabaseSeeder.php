<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(SiswaSeeder::class);
        $this->call(\Database\Seeders\UserSeeder::class);
        $this->call(GuruSeeder::class);
        $this->call(MataPelajaranSeeder::class);
        $this->call(TahunAkademikSeeder::class);
    }
}
