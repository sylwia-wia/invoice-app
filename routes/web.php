<?php

use App\Http\Controllers\ContractorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
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

Route::get('contractors', [ContractorController::class, 'index']);

Route::get('products', [ProductController::class, 'index']);


Route::get('contractors/create', [ContractorController::class, 'create'])
    ->name('contractor.create');
Route::post('contractors/create', [ContractorController::class, 'store']);
Route::get('contractors/{contractor:id}', function (Contractor $contractor) {
    return view('contractor', [
        'contractor' => $contractor
    ]);
});


Route::get('products/{product:id}', function (Product $product) {
    return view('product', [
        'product' => $product
    ]);
});





Route::get('register', [RegisterController::class, 'create'])->middleware('guest')
    ->name('register.create');

Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionController::class, 'create'])->middleware('guest')
    ->name('login.create');
Route::post('login', [SessionController::class, 'store'])->middleware('guest');

Route::post('logout', [SessionController::class, 'destroy'])->middleware('auth');
