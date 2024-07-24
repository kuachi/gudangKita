<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Muhammad rahmat Mutik',
            'username' => 'rahmat20',
            'email' => 'muhammatrahmatmutik2002@gmail.com',
            'password' => bcrypt('password'),
            'image' => '/storage/images/rahmat.png'
        ]);

        User::create([
            'name' => 'Rizky Andriawan',
            'username' => 'ghelgameshra',
            'email' => 'ghelgameshra3347@gmail.com',
            'password' => bcrypt('gh3lgameshra'),
            'image' => '/storage/images/linux.png'
        ]);
    }
}
