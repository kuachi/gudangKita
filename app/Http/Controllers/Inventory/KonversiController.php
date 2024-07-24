<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\HelperController;
use App\Models\Inventory\BarangMasuk;
use App\Models\Inventory\KonversiPlu;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KonversiController extends Controller
{
    public function index()
    {
        return view('dashboard.konversi-plu.index', [
            'title' => 'Konversi PLU'
        ]);
    }

    public function search(Request $request)
    {
        $data = DB::table('products')->where('name', 'LIKE', "%$request->search%")
        ->where('jenis_plu', 'KONV')
        ->get(['plu', 'name']);
        $plu = $data->map(function ($value) {
            return [
                'id' => $value->plu,
                'text' => $value->name,
            ];
        });

        return response()->json([
            'data' => $plu
        ], 200);
    }

    public function searchPluAsal(Request $request)
    {
        $data = DB::table('konversi_plu')->where('plu_asal', 'LIKE', "%$request->search%")
        ->where('plu_akhir', $request->plu_akhir)
        ->get(['plu_asal']);

        $plu = [];
        foreach ($data as $key => $value) {
            $plu[] = $value->plu_asal;
        }

        $produk = Product::whereIn('plu', $plu)->get();

        $kategori = $produk->map(function ($value) {
            return [
                'id' => $value->plu,
                'text' => $value->name,
            ];
        });

        return response()->json([
            'data' => $kategori
        ], 200);
    }

    public function getDataKonv(Request $request)
    {
        return response()->json([
            'data' => KonversiPlu::where('plu_asal', $request->plu_asal)->where('plu_akhir', $request->plu_akhir)->first()
        ], 200);
    }

    public function create(Request $request)
    {
        $pluKonv = KonversiPlu::where('plu_asal', $request->plu)->where('plu_akhir', $request->plu_akhir)->first();
        $produkAsal = Product::where('plu', $request->plu)->first();
        $produk = Product::where('plu', $request->plu_akhir)->first();

        $barangMasuk = BarangMasuk::create([
            'plu' => $request->plu,
            'jumlah' => $request->stock_konversi,
            'harga' => $produk->price,
            'total' => $produk->price * $request->jumlah,
            'info' => "konversi: stock awal=$produk->stock,stock akhir=" . $produk->stock + ($pluKonv->qty_hasil*$request->stock_konversi)
        ]);

        $invno = new HelperController();
        $barangMasuk->invno = $invno->buatInvnoBarang($barangMasuk->created_at, $barangMasuk->id, "KONV");
        $barangMasuk->save();

        $produk->stock += ($pluKonv->qty_hasil*$request->stock_konversi);
        $produk->save();

        $produkAsal->stock -= $request->stock_konversi;
        $produkAsal->save();

        return response()->json($barangMasuk);
    }
}
