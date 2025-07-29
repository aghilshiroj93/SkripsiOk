<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Guru;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'name' => 'Guru Satu',
            'email' => 'guru1@gmail.com',
            'password' => Hash::make('guru1234'),
            // 'role' => 'guru', // Uncomment jika ada kolom role
        ]);

        Guru::create([
            'user_id' => $user->id,
            'nip' => '12345678',
            'nama' => 'Guru Satu',
            'jenis_kelamin' => 'L',
            'alamat' => 'Jl. Pendidikan No.1',
            'no_hp' => '081234567890',
        ]);
    }
}
