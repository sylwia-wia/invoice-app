<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('name');



        return view('products', [
            'products' => Product::orderBy('name')->filter(
                request(['searchProduct']))
                ->paginate(20)->withQueryString()
        ]);
    }
}
