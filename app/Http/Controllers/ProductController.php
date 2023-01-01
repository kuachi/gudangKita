<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function showProducts(){        
        return view('dashboard.products.index', [
            'title' => 'Products',
            'products' => Product::all()
        ]);
    }
}
