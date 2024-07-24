<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\HelperController;
use App\Models\Inventory\BarangKeluar;
use App\Models\Product;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangKeluarController extends Controller
{
    public function index()
    {
        return view('dashboard.barang-keluar.index', [
            'title' => 'Barang Keluar'
        ]);
    }

    public function get()
    {
        $data = DB::table('barang_keluar')->join('products', 'products.plu', 'barang_keluar.plu')
        ->select('barang_keluar.*', 'products.name AS nama_produk', 'products.produsen', 'products.stock')
        ->orderBy('barang_keluar.created_at', 'desc')
        ->get();

        foreach ($data as $key => $value) {
            $value->nomor = $key+1;
        }

        return response()->json([
            'data' => $data
        ], 200);
    }

    public function search(Request $request)
    {
        $data = DB::table('products')->where('name', 'LIKE', "%$request->search%")->get(['plu', 'name']);
        $kategori = $data->map(function ($value) {
            return [
                'id' => $value->plu,
                'text' => $value->name,
            ];
        });

        return response()->json([
            'data' => $kategori
        ], 200);
    }

    public function create(Request $request)
    {
        $produk = Product::where('plu', $request->plu)->first();
        $barangKeluar = BarangKeluar::create([
            'plu' => $request->plu,
            'jumlah' => $request->jumlah,
            'harga' => $produk->price,
            'total' => $produk->price * $request->jumlah,
            'info' => "stock awal=$produk->stock,stock akhir=" . $produk->stock - $request->jumlah
        ]);

        $invno = new HelperController();
        $barangKeluar->invno = $invno->buatInvnoBarang($barangKeluar->created_at, $barangKeluar->id, 'OUT');
        $barangKeluar->save();

        $produk->stock = $produk->stock - $request->jumlah;
        $produk->save();

        return response()->json($barangKeluar);
    }
}
