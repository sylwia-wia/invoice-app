<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContractorRequest;
use App\Models\Contractor;
use App\Models\Product;
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

    public function create(): View
    {
        return view('contractors.create');
    }

    public function store(StoreContractorRequest $request): RedirectResponse
    {
        $attributes = $request->validated();

        Contractor::create($attributes);

        return redirect('/contractors')->with('success', 'Poprawnie dodano nowego  kontrahenta!');
    }

    public function edit($id): View
    {
        $contractor = Contractor::findOrFail($id);

        return view('contractors/edit', [
            'contractor' => $contractor
        ]);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $contractor = Contractor::findOrFail($id);
        $validationRules = $this->validationRules();
        $validationRules['nip'] .= ',' . $contractor->id;
        $attributes = $request->validate($validationRules);
        $contractor->update($attributes);

        return redirect()->route('contractors.index')->with('success', 'Poprawnie edytowano kontrahenta!');

    }

    protected function validationRules(): array
    {
        return [
            'name' => 'required|max:255',
            'company_name' => 'required|max:255',
            'nip' => 'required|max:15|unique:contractor,nip',
            'street' => 'required|max:255',
            'locality' => 'required|max:255',
            'post_code' => 'required:max:255'
        ];
    }

    public function destroy($id)
    {
        $contractor = Contractor::findOrFail($id);
        $contractor->delete();

        return redirect()->route('contractors.index')->with('success', 'Poprawnie usunięto kontrahenta!');
    }


}
