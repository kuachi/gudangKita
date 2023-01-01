<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Muhammad rahmat Mutik',
            'username' => 'rahmat20',
            'email' => 'muhammatrahmatmutik2002@gmail.com',
            'password' => bcrypt('password')
        ]);
    }

    
}
