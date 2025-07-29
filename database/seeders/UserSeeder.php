<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('admin1234'),
        ]);

        User::create([
            'name' => 'BK',
            'email' => 'bk@gmail.com',
            'role' => 'bk',
            'password' => Hash::make('bk1234'),
        ]);
    }
}
