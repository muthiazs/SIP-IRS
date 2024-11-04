<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;



class UserSeeder extends Seeder
{
    public function run()
    {
        // Dosen dekan
        User::create([
            'id'=>'1',
            'username' => 'Kusworo Adi',
            'email' => 'kusworo@lectures.university.ac.id',
            'password' => Hash::make('password'),
            'roles1' => 'dosen',
            'roles2' => 'kaprodi',
            'created_at' => now(), // Set created_at to current timestamp
            'remember_token' => Str::random(100) // Generate a random remember token
        ]);

        // Dosen kaprodi
        User::create([
            'id'=>'2',
            'username' => 'Aris Sugiharto',
            'email' => 'arissugi@lectures.university.ac.id',
            'password' => Hash::make('password'),
            'roles1' => 'dosen',
            'roles2' => 'kaprodi',
            'created_at' => now(), // Set created_at to current timestamp
            'remember_token' => Str::random(100) // Generate a random remember token
        ]);

        // Dosen saja
        User::create([
            'id'=>'3',
            'username' => 'Dinar Mutiara',
            'email' => 'dinar@lectures.university.ac.id',
            'password' => Hash::make('password'),
            'roles1' => 'dosen',
            'roles2' => '',
            'created_at' => now(), // Set created_at to current timestamp
            'remember_token' => Str::random(100) // Generate a random remember token
        ]);

        //Akademik
        User::create([
            'id'=>'4',
            'username' => 'Awang Kurniawan',
            'email' => 'awang@staff.university.ac.id',
            'password' => Hash::make('password'),
            'roles1' => 'akademik',
            'roles2' => '',
            'created_at' => now(), // Set created_at to current timestamp
            'remember_token' => Str::random(100) // Generate a random remember token
        ]);

        // Mahasiswa
        User::create([
            'id'=>'5',
            'username' => 'Muthia Zhafira Sahnah',
            'email' => 'muthia@students.university.ac.id',
            'password' => Hash::make('password'),
            'roles1' => 'mahasiswa',
            'roles2' => '',
            'created_at' => now(), // Set created_at to current timestamp
            'remember_token' => Str::random(100) // Generate a random remember token
        ]);

        // Mahasiswa2
        User::create([
            'id'=>'6',
            'username' => 'Alya Safina',
            'email' => 'alya@students.university.ac.id',
            'password' => Hash::make('password'),
            'roles1' => 'mahasiswa',
            'roles2' => '',
            'created_at' => now(), // Set created_at to current timestamp
            'remember_token' => Str::random(100) // Generate a random remember token
        ]);

         // Mahasiswa3
         User::create([
            'id'=>'7',
            'username' => 'Nadiva Aulia',
            'email' => 'nadiva@students.university.ac.id',
            'password' => Hash::make('password'),
            'roles1' => 'mahasiswa',
            'roles2' => '',
            'created_at' => now(), // Set created_at to current timestamp
            'remember_token' => Str::random(100) // Generate a random remember token
        ]);

        // Mahasiswa4
        User::create([
            'id'=>'8',
            'username' => 'Tirza Aurellia',
            'email' => 'tirza@students.university.ac.id',
            'password' => Hash::make('password'),
            'roles1' => 'mahasiswa',
            'roles2' => '',
            'created_at' => now(), // Set created_at to current timestamp
            'remember_token' => Str::random(100) // Generate a random remember token
        ]);
        
    }
}