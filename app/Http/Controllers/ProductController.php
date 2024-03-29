<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Models\Unit;
use App\Models\VatRate;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\Console\Input\Input;

class ProductController extends Controller
{
    public function index()
    {
        return view('products', [
            'products' => Product::where('name', 'like', '%' . \request('search') . '%')
                ->paginate(20)->withQueryString()
        ]);
    }

    public function create()
    {
        $vatRates = VatRate::all();
        $units = Unit::all();

        return view('products.create', [
            'vatRates' => $vatRates,
            'units' => $units
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        $attributes = $request->validated();

        Product::create($attributes);

        return redirect()->route('products.index')->with('success', 'Poprawnie dodano nowy produkt!');
    }

    /**
     * @return View
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $vatRates = VatRate::all();
        $units = Unit::all();

        return view('products.edit', [
            'product' => $product,
            'vatRates' => $vatRates,
            'units' => $units
        ]);
    }

    public function detailJson($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    /**
     * @param StoreProductRequest $request
     * @param $id
     * @return RedirectResponse|Redirector
     * @throws \Exception
     */
    public function update(StoreProductRequest $request, Product $product)
    {
        $product = Product::findOrFail($product->id);

        $validationRules = $request->validated();

        $product->update($validationRules);

        return redirect()->route('products.index')->with('success', 'Poprawnie edytowano produkt!');
    }


    /**
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('succcess', 'Poprawnie usunięto produkt!');
    }
}




