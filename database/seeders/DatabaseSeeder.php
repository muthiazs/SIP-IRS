<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;



class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Mahasiswa
        User::create([
            'id'=>'24060122130071',
            'username' => 'Mahasiswa Test',
            'email' => 'mahasiswa@test.com',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
            'created_at' => now(), // Set created_at to current timestamp
            'remember_token' => Str::random(100) // Generate a random remember token
        ]);

        // Dosen
        User::create([
            'id'=>'219700000000',
            'username' => 'Dosen Test',
            'email' => 'dosen@test.com',
            'password' => Hash::make('password'),
            'role' => 'dosen',
            'created_at' => now(), // Set created_at to current timestamp
            'remember_token' => Str::random(100) // Generate a random remember token
        ]);

        // K
        User::create([
            'id'=>'246000000000',
            'username' => 'Kaprodi Test',
            'email' => 'kaprodi@test.com',
            'password' => Hash::make('password'),
            'role' => 'kaprodi',
            'created_at' => now(), // Set created_at to current timestamp
            'remember_token' => Str::random(100) // Generate a random remember token
        ]);

        // Tambahkan user lain sesuai kebutuhan
    }
}