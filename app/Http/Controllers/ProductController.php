<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Models\VatRate;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Symfony\Component\Console\Input\Input;

class ProductController extends Controller
{
    public function index()
    {
        return view('products', [
            'products' => Product::orderBy('name')->filter(
                request(['searchProduct']))
                ->paginate(20)->withQueryString()
        ]);
    }

    public function create()
    {
        $vatRates = VatRate::all();

        return view('products.create', [
            'vatRates' => $vatRates
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        $attributes = $request->validated();
//        $attributes = request()->validate($this->validationRules());

        Product::create($attributes);

        return redirect('/products')->with('success', 'Poprawnie dodano nowy produkt!');
    }

    /**
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $vatRates = VatRate::all();

        return view('products/edit', [
            'product' => $product,
            'vatRates' => $vatRates
        ]);
    }

    public function update(StoreProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        $validationRules = $this->validationRules();
        $validationRules['name'] .= ',' . $product->id;

        $attributes = $request->validate($validationRules);

        $product->update($attributes);

        return redirect('/products')->with('success', 'Poprawnie edytowano produkt!');
    }

    protected function validationRules(): array
    {
        return [
            'name' => 'required|max:100|unique:product,name',
            'vat_rate_id' => 'required|integer|exists:vat_rate,id',
            'price' => 'required|numeric|gt:0|lt:99999999'
        ];
    }

    /**
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect('/products')->with('succcess', 'Poprawnie usunięto produkt!');
    }
}




