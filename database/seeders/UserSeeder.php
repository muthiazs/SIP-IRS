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
            'roles2' => 'dekan',
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

        User::create([
            'id'=>'9',
            'username' => 'Beta Noranita',
            'email' => 'beta@lectures.university.ac.id',
            'password' => Hash::make('password'),
            'roles1' => 'dosen',
            'roles2' => '',
            'created_at' => now(),
            'remember_token' => Str::random(100)
        ]);
        
        // Dosen D2
        User::create([
            'id'=>'10',
            'username' => 'Dr. Aris Puji Widodo',
            'email' => 'aris@lectures.university.ac.id',
            'password' => Hash::make('password'),
            'roles1' => 'dosen',
            'roles2' => '',
            'created_at' => now(),
            'remember_token' => Str::random(100)
        ]);
        
        // Dosen D3
        User::create([
            'id'=>'11',
            'username' => 'Dr. Indra Waspada',
            'email' => 'indra@lectures.university.ac.id',
            'password' => Hash::make('password'),
            'roles1' => 'dosen',
            'roles2' => '',
            'created_at' => now(),
            'remember_token' => Str::random(100)
        ]);
        
        // Dosen D4
        User::create([
            'id'=>'12',
            'username' => 'Dr. Retno Kusumaningrum',
            'email' => 'retno@lectures.university.ac.id',
            'password' => Hash::make('password'),
            'roles1' => 'dosen',
            'roles2' => '',
            'created_at' => now(),
            'remember_token' => Str::random(100)
        ]);
        
        // Dosen D5
        User::create([
            'id'=>'13',
            'username' => 'Rismiyati',
            'email' => 'rismiyati@lectures.university.ac.id',
            'password' => Hash::make('password'),
            'roles1' => 'dosen',
            'roles2' => '',
            'created_at' => now(),
            'remember_token' => Str::random(100)
        ]);
        
        // Dosen D6
        User::create([
            'id'=>'14',
            'username' => 'Sandy Kurniawan',
            'email' => 'sandy@lectures.university.ac.id',
            'password' => Hash::make('password'),
            'roles1' => 'dosen',
            'roles2' => '',
            'created_at' => now(),
            'remember_token' => Str::random(100)
        ]);
        
        // Dosen D7
        User::create([
            'id'=>'15',
            'username' => 'Yunila Dwi Putri Ariyanti',
            'email' => 'yunila@lectures.university.ac.id',
            'password' => Hash::make('password'),
            'roles1' => 'dosen',
            'roles2' => '',
            'created_at' => now(),
            'remember_token' => Str::random(100)
        ]);
        
        // Dosen D8
        User::create([
            'id'=>'16',
            'username' => 'Dr. Yeva Fadhilah Ashari',
            'email' => 'yeva@lectures.university.ac.id',
            'password' => Hash::make('password'),
            'roles1' => 'dosen',
            'roles2' => '',
            'created_at' => now(),
            'remember_token' => Str::random(100)
        ]);
        
        // Dosen D9
        User::create([
            'id'=>'17',
            'username' => 'Etna Vianita',
            'email' => 'etna@lectures.university.ac.id',
            'password' => Hash::make('password'),
            'roles1' => 'dosen',
            'roles2' => '',
            'created_at' => now(),
            'remember_token' => Str::random(100)
        ]);
        
        // Dosen D10
        User::create([
            'id'=>'18',
            'username' => 'Prof. Dr. Dra. Meiny Suzery',
            'email' => 'meiny@lectures.university.ac.id',
            'password' => Hash::make('password'),
            'roles1' => 'dosen',
            'roles2' => '',
            'created_at' => now(),
            'remember_token' => Str::random(100)
        ]);
        
        // Dosen D11
        User::create([
            'id'=>'19',
            'username' => 'Dr. rer. nat. Anto Budiharjo',
            'email' => 'anto@lectures.university.ac.id',
            'password' => Hash::make('password'),
            'roles1' => 'dosen',
            'roles2' => '',
            'created_at' => now(),
            'remember_token' => Str::random(100)
        ]);
        
        // Dosen D12
        User::create([
            'id'=>'20',
            'username' => 'Prof. Dr. Widowati',
            'email' => 'widowati@lectures.university.ac.id',
            'password' => Hash::make('password'),
            'roles1' => 'dosen',
            'roles2' => '',
            'created_at' => now(),
            'remember_token' => Str::random(100)
        ]);
        
        // Dosen D13
        User::create([
            'id'=>'21',
            'username' => 'Arief Rachman Hakim',
            'email' => 'arief@lectures.university.ac.id',
            'password' => Hash::make('password'),
            'roles1' => 'dosen',
            'roles2' => '',
            'created_at' => now(),
            'remember_token' => Str::random(100)
        ]);

        // Dosen touhou iloveyou dewi suwako
        User::create([
            'id'=>'22',
            'username' => 'Dewi Suwako Moriya',
            'email' => 'suwako@lectures.university.ac.id',
            'password' => Hash::make('password'),
            'roles1' => 'dosen',
            'roles2' => '',
            'created_at' => now(),
            'remember_token' => Str::random(100)
        ]);

        //Kaprodi untuk prodi Kimia
        User::create([
            'id'=>'23',
            'username'=>'Prof. Adi Darmawan, S.Si, M.Si, Ph.D',
            'email' => 'adidarmawan@lectures.university.ac.id',
            'password'=> Hash::make('password'),
            'roles1' => 'dosen',
            'roles2' => 'kaprodi',
            'created_at' => now(),
            'remember_token' => Str::random(100)
        ]);
        // Mahasiswa Kimia
        User::create([
            'id'=>'24',
            'username' => 'Raynor Raazan Zaidan',
            'email' => 'Raynor@students.university.ac.id',
            'password' => Hash::make('password'),
            'roles1' => 'mahasiswa',
            'roles2' => '',
            'created_at' => now(), // Set created_at to current timestamp
            'remember_token' => Str::random(100) // Generate a random remember token
        ]);
        
    }
}