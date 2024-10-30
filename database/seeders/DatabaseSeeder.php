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
            'roles1' => 'mahasiswa',
            'roles2' => '',
            'created_at' => now(), // Set created_at to current timestamp
            'remember_token' => Str::random(100) // Generate a random remember token
        ]);

        // Dosen
        User::create([
            'id'=>'219700000000',
            'username' => 'Dosen Test',
            'email' => 'dosen@test.com',
            'password' => Hash::make('password'),
            'roles1' => 'dosen',
            'roles2' => '',
            'created_at' => now(), // Set created_at to current timestamp
            'remember_token' => Str::random(100) // Generate a random remember token
        ]);

        // K
        User::create([
            'id'=>'246000000000',
            'username' => 'Kaprodi Test',
            'email' => 'kaprodi@test.com',
            'password' => Hash::make('password'),
            'roles1' => 'dosen',
            'roles2' => 'kaprodi',
            'created_at' => now(), // Set created_at to current timestamp
            'remember_token' => Str::random(100) // Generate a random remember token
        ]);

        //Dekan
        User::create([
            'id'=>'123456789012',
            'username' => 'Dekan Test',
            'email' => 'dekan@test.com',
            'password' => Hash::make('password'),
            'roles1' => 'dosen',
            'roles2' => 'dekan',
            'created_at' => now(), // Set created_at to current timestamp
            'remember_token' => Str::random(100) // Generate a random remember token
        ]);

        // Tambahkan user lain sesuai kebutuhan
        //Akademik
        User::create([
            'id'=>'1234567890100',
            'username' => 'Akademik Test',
            'email' => 'akademik@test.com',
            'password' => Hash::make('password'),
            'roles1' => 'akademik',
            'roles2' => '',
            'created_at' => now(), // Set created_at to current timestamp
            'remember_token' => Str::random(100) // Generate a random remember token
        ]);
    }
}