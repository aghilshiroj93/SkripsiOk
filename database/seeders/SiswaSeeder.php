<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        foreach (range(1, 20) as $index) {
            DB::table('siswa')->insert([
                'nis' => $faker->unique()->numberBetween(100000, 999999),
                'nisn' => $faker->unique()->numerify('##########'),
                'nama' => $faker->name,
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date('Y-m-d', '2010-01-01'),
                'alamat' => $faker->address,
                'no_hp' => "082232811129",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
