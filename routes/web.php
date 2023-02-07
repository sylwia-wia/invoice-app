<?php

use App\Http\Controllers\BusinessDocumentController;
use App\Http\Controllers\ContractorController;
use App\Http\Controllers\PDFController;
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

Route::resources([
    'products' => ProductController::class,
    'contractors' => ContractorController::class,
    'business_documents' => BusinessDocumentController::class
]);

//Route::resource('products', ProductController::class);

Route::get('products/{product:id}/json', [ProductController::class, 'detailJson'])
    ->name('product.detail.json');

//Route::resource('contractors', ContractorController::class);

//Route::resource('business_documents', BusinessDocumentController::class);
//
//Route::get('business_documents', [BusinessDocumentController::class, 'index'])
//    ->name('business_documents.index');
//Route::get('business_documents/create', [BusinessDocumentController::class, 'create'])
//    ->name('business_documents.create');
//Route::post('business_documents/create', [BusinessDocumentController::class, 'store'])
//    ->name('business_document.create');
//Route::get('business_documents/{business_document:id}/show', [BusinessDocumentController::class, 'show'])
//    ->name('business_documents.show');
//Route::get('business_documents/{business_document:id}/edit', [BusinessDocumentController::class, 'edit'])
//    ->name('business_documents.edit');
//Route::post('business_documents/{business_document:id}', [BusinessDocumentController::class, 'update'])
//    ->name('business_documents.update');
//Route::post('business_documents/{business_document:id}/destroy', [BusinessDocumentController::class, 'destroy'])
//    ->name('business_documents.destroy');

Route::get('business_documents/{business_document:id}/settle', [BusinessDocumentController::class, 'settlementForm'])
    ->name('business_documents.settlement_form');
Route::post('business_documents/{business_document:id}/settle', [BusinessDocumentController::class, 'settlement'])
    ->name('business_documents.settlement');

Route::get('register', [RegisterController::class, 'create'])->middleware('guest')
    ->name('register.create');

Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionController::class, 'create'])->middleware('guest')
    ->name('login.create');
Route::post('login', [SessionController::class, 'store'])->middleware('guest');

Route::post('logout', [SessionController::class, 'destroy'])->middleware('auth');

Route::get('business_documents/generate-pdf/{business_document:id}', [PDFController::class, 'generatePDF'])
    ->name('business_document.generatePDF');
