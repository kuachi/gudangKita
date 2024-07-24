<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\HelperController;
use App\Models\Inventory\BarangMasuk;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangMasukController extends Controller
{
    public function index()
    {
        return view('dashboard.barang-masuk.index', [
            'title' => 'Barang Masuk'
        ]);
    }

    public function create(Request $request)
    {
        $produk = Product::where('plu', $request->plu)->first();

        $barangMasuk = BarangMasuk::create([
            'plu' => $request->plu,
            'jumlah' => $request->jumlah,
            'harga' => $produk->price,
            'total' => $produk->price * $request->jumlah,
            'info' => "stock awal=$produk->stock,stock akhir=" . $produk->stock + $request->jumlah
        ]);

        $invno = new HelperController();
        $barangMasuk->invno = $invno->buatInvnoBarang($barangMasuk->created_at, $barangMasuk->id, "IN");
        $barangMasuk->save();

        $produk->stock = $produk->stock + $request->jumlah;
        $produk->save();

        return response()->json($barangMasuk);
    }

    public function get(Request $request)
    {
        $data = DB::table('barang_masuk')->join('products', 'products.plu', 'barang_masuk.plu')
        ->where('barang_masuk.invno', 'LIKE', "%$request->jenis%")
        ->select('barang_masuk.*', 'products.name AS nama_produk', 'products.produsen', 'products.stock')
        ->orderBy('barang_masuk.created_at', 'desc')
        ->get();

        foreach ($data as $key => $value) {
            $value->nomor = $key+1;
        }

        return response()->json([
            'data' => $data
        ], 200);
    }
}
