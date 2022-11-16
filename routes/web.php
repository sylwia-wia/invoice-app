<?php

use Illuminate\Support\Facades\Route;
use App\Models\Contractor;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('contractors', function () {
    $contractors = Contractor::orderBy('name');
   
    if(request('search')) {
        $contractors->where('name','like','%'.request('searchContractor').'%');
    }

    return view('contractors', [
        'contractors' => $contractors->get()
    ]);
});

Route::get('products', function () {
    $products = Product::orderBy('name');

    if(request('searchProduct')) {
        $products->where('name','like','%'.request('searchProduct').'%');
    }

    return view('products', [
        'products' => $products->get()
    ]);
});

Route::get('products/{product:name}', function (Product $product) {
    return view('product', [
        'product' => $product
    ]);
});

Route::get('contractors/{contractor:companyName}', function (Contractor $contractor) {
    return view('contractor', [
        'contractor' => $contractor
    ]);
});

//Route::get('posts/{post}', function ($slug) {
//    return view('post', [
//        'post' => Post::findOrFail($slug)
//    ]);
//
//});
