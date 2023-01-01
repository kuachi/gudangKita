<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;

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

        Product::create([
            'category_id' => '2',
            'name' => 'Beras bulog',
            'slug' => 'beras-bulog',
            'produsen' => 'Bulog',
            'stock' => 10,
            'unit' => 'Karung',
            'price' => 225000,
            'image' => '/storage/images/products/bulog.png'
        ]);







        Category::create([
            'name' =>'Kebutuhan Rumah Tangga',
            'slug' => 'kebutuhan-rumah-tangga',
        ]);

        Category::create([
            'name' =>'Sembako',
            'slug' => 'sembako',
        ]);

        Category::create([
            'name' =>'Obat-obatan',
            'slug' => 'obat-obatan',
        ]);

        // kategori
        // 1. kebutuhan rumah tangga
        // 2. sembako
        // 3. obat - obatan
        // 4. bahan bakar
        // 5. air mineral
        // 6. elektronik
    }

    
}
