<?php

use App\Http\Controllers\AutoAddressController;
use App\Http\Controllers\BusinessDocumentController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ContractorController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SendMailController;
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

Route::get('/', [ChartController::class, 'index'])->name('chart.index');

Route::resources([
    'products' => ProductController::class,
    'contractors' => ContractorController::class,
    'business_documents' => BusinessDocumentController::class
]);

Route::get('products/{product:id}/json', [ProductController::class, 'detailJson'])
    ->name('product.detail.json');

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


Route::post('business_documents/{business_document:id}/send_mail', [BusinessDocumentController::class, 'sendMail'])->name('email.send');
Route::get('business_documents/{business_document:id}/send', [BusinessDocumentController::class, 'confirmMail'])->name('email.confirm');

Route::get('business_documents/{business_document:id}/delete', [BusinessDocumentController::class, 'confirmDelete'])->name('business_documents.confirm.delete');
