<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContractorRequest;
use App\Models\Contractor;
use App\Models\Product;
use http\Url;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;



class ContractorController extends Controller
{
    public function index(): View
    {
        $query = Contractor::query();
        return view('contractors', [
            'contractors' => $query
                ->where('name', 'like', '%' . \request('search') . '%')
                ->orWhere('nip', 'like', '%' . \request('search') . '%')
                ->orWhere('locality', 'like', '%' . \request('search') . '%')
                ->paginate(20)->withQueryString()
        ]);

    }

    public function create(Request $request): View
    {
        if ($request->ajax()) {
            return view('contractors._create_template', [
                'redirect' => \URL::previous(),
            ]);
        }

        return view('contractors.create');
    }

    public function store(StoreContractorRequest $request): RedirectResponse
    {
        $redirect = $request->get('redirect');
        $attributes = $request->validated();

        Contractor::create($attributes);

        if ($redirect !== null) {
            return redirect($redirect)->with('success', 'Poprawnie dodano nowego  kontrahenta!');
        }

        return redirect('/contractors')->with('success', 'Poprawnie dodano nowego  kontrahenta!');
    }

    public function edit($id): View
    {
        $contractor = Contractor::findOrFail($id);

        return view('contractors/edit', [
            'contractor' => $contractor
        ]);
    }

    public function update(StoreContractorRequest $request, Contractor $contractor): RedirectResponse
    {
        $contractor = Contractor::findOrFail($contractor->id);
        $validationRules = $request->validated();
        $contractor->update($validationRules);

        return redirect()->route('contractors.index')->with('success', 'Poprawnie edytowano kontrahenta!');

    }

    public function destroy($id)
    {
        $contractor = Contractor::findOrFail($id);
        $contractor->delete();

        return redirect()->route('contractors.index')->with('success', 'Poprawnie usunięto kontrahenta!');
    }

}
