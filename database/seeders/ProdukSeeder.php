<?php

namespace Database\Seeders;

use App\Http\Controllers\Helper\HelperController;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::select('TRUNCATE products');
        $data = [
            [
                'name' => 'ROKOK CTN',
                'category_id' => 1,
                'slug' => 'rokok-ctn',
                'produsen' => 'CV. BASMALAH GROUP',
                'unit' => 'KARTON',
                'price' => 6800000,
                'stock' => 0,
                'jenis_plu' => 'RAW',
            ],
            [
                'name' => 'SANTAN CTN',
                'category_id' => 1,
                'slug' => 'santan-ctn',
                'produsen' => 'CV. BASMALAH GROUP',
                'unit' => 'KARTON',
                'price' => 223000,
                'stock' => 0,
                'jenis_plu' => 'RAW',
            ],
            [
                'name' => 'ROKOK KONV',
                'category_id' => 3,
                'slug' => 'rokok-konv',
                'produsen' => 'CV. BASMALAH GROUP-KONV',
                'unit' => 'BAL',
                'price' => 340000,
                'stock' => 0,
                'jenis_plu' => 'KONV',
            ],
        ];

        $plu = new HelperController();
        foreach ($data as $key => $value) {
            Product::create([
                'category_id' => $value['category_id'],
                'name' => $value['name'],
                'slug' => $value['slug'],
                'produsen' => $value['produsen'],
                'stock' => $value['stock'],
                'unit' => $value['unit'],
                'price' => $value['price'],
                'jenis_plu' => $value['jenis_plu'],
                'plu' => $plu->buatPlu(now(), $key+1)
            ]);
        }

    }
}
