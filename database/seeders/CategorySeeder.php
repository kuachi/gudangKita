<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ctgr = ['LAIN-LAIN', 'MAKANAN'];
        foreach ($ctgr as $key => $value) {
            Category::create([
                'name' => $value,
                'slug' => strtolower($value)
            ]);
        }
    }
}
