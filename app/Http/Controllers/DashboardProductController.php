<?php

namespace App\Http\Controllers;

use \Cviebrock\EloquentSluggable\Services\SlugService;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.products.index', [
            'title' => 'All porducts',
            'products' => Product::orderBy('category_id')->get(),
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.products.create', [
            'title' => 'Add product',
            'products' => Product::orderBy('category_id')->get(),
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $rules = [
            'category_id' => 'required',
            'name' =>'required',
            'produsen' => 'required',
            'stock' => 'Integer|required',
            'unit' => 'required',
            'price' => 'Integer|required',
            'image' => 'image|file|max:2048'
        ];

        $validatedData = $request->validate($rules);

        // store images to folder
        if( $request->file('image') ){
            $validatedData['image'] = $request->file('image')->store('images/products');
        }

        $newSlug = $request->name;
        $newSlug = strtolower($newSlug);

        // // replace space with -
        $newSlug = str_replace(' ', '-', $newSlug);

        // adding minute to slug
        $newSlug = $newSlug . "-" . now()->format('i');

        $validatedData['slug'] = $newSlug;

        // dd(no);

        if(Product::create($validatedData)){
            return redirect('/dashboard/products')->with('success', 'New product has been added!');
        }

        return redirect('/dashboard/products/create')->with('success', 'New product failed to added!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product['image'] = "/storage/" . $product['image'];
        // dd($product->image);
        return view('dashboard.products.show', [
            'title' => $product->name,
            'products' => Product::orderBy('category_id')->get(),
            'categories' => Category::all(),
            'productShow' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $product['image'] = "/storage/" . $product['image'];
        return view('dashboard.products.edit', [
            'title' => 'Edit data',
            'productEdit' => $product,
            'products' => Product::orderBy('category_id')->get(),
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        $rules = [
            'category_id' => 'required',
            'name' =>'required',
            'produsen' => 'required',
            'stock' => 'required',
            'unit' => 'required',
            'price' => 'required',
        ];


        $validatedData = $request->validate($rules);


        Product::where('id', $product->id)
            ->update($validatedData);

        return redirect('/dashboard/products')->with('success', 'A product has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Product::destroy( $product->id );
        return redirect('/dashboard/products')->with('success', 'A product has been deleted!');
    }

    public function checkSlug( Request $request ){
        $slug = SlugService::createSlug(Product::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }

    public function get(Request $request)
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

    public function getDetail(Request $request)
    {
        $produk = DB::table('products')->where('plu', $request->plu)->first();
        return response()->json([
            'data' => $produk
        ], 200);
    }
}
