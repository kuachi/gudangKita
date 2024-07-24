<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::select('TRUNCATE categories');

        $ctgr = ['LAIN-LAIN', 'MAKANAN', 'KONVERSI'];
        foreach ($ctgr as $key => $value) {
            Category::create([
                'name' => $value,
                'slug' => strtolower($value)
            ]);
        }
    }
}
