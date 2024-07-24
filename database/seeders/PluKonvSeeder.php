<?php

namespace Database\Seeders;

use App\Models\Inventory\KonversiPlu;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PluKonvSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::select('TRUNCATE konversi_plu');

        $data = Product::where('name', 'LIKE', '%rokok%')->get();
        $this->make($data);

        $data = Product::where('name', 'LIKE', '%santan%')->get();
        $this->make($data);
    }

    public function make($data)
    {
        $plu_asal = '';
        $plu_akhir = '';
        if($data->count() == 2){
            $plu_asal = $data[0];
            $plu_akhir = $data[1];

            KonversiPlu::create([
                'plu_asal' => $plu_asal->plu,
                'plu_akhir' => $plu_akhir->plu,
                'qty' => 1,
                'unit' => $plu_asal->unit,
                'qty_hasil' => 4,
                'unit_hasil' => $plu_akhir->unit
            ]);
        }
    }
}
