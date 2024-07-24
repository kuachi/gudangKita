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

        $produk = new Product();
        $produk->category_id = 1;
        $produk->name = 'ROKOK';
        $produk->slug = 'rokok';
        $produk->produsen = 'CV. BASMALAH GROUP';
        $produk->unit = 'KARTON';
        $produk->price = 6800000;
        $produk->stock = 0;
        $produk->save();

        $helper = new HelperController();
        $produk->update([
            'plu' => $helper->buatPlu(now(), $produk->id)
        ]);

        $produk = new Product();
        $produk->category_id = 1;
        $produk->name = 'SANTAN';
        $produk->slug = 'santan';
        $produk->produsen = 'CV. BASMALAH GROUP';
        $produk->unit = 'KARTON';
        $produk->price = 200000;
        $produk->stock = 0;
        $produk->save();

        $helper = new HelperController();
        $produk->update([
            'plu' => $helper->buatPlu(now(), $produk->id)
        ]);
    }
}
