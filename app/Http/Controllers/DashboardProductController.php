<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Produk;
use Illuminate\Http\Request;

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
            'title' => 'Add porduct',
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
            'slug' => 'required|unique:products',
            'produsen' => 'required',
            'stock' => 'required',
            'unit' => 'required',
            'price' => 'required'
        ];

        $validatedData = $request->validate($rules);
        Product::create($validatedData);

        return redirect('/dashboard/products')->with('success', 'New product has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
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
        //
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
        //
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
}
