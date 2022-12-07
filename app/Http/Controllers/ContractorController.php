<?php

namespace App\Http\Controllers;

use App\Models\Contractor;
use App\Models\User;
use Illuminate\Http\Request;

class ContractorController extends Controller
{
    public function index()
    {
        return view('contractors', [
            'contractors' => Contractor::orderBy('name')->filter(
                request(['searchContractor'])
            )
                ->paginate(20)->withQueryString()
        ]);
    }

    public function create()
    {
        return view('contractors.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required|max:100|unique:contractor,name',
            'company_name' => 'required|max:100|unique:contractor,company_name',
            'nip' => 'required|max:20|unique:contractor,nip',
            'street' => 'required|max:255',
            'locality' => 'required|max:50',
            'post_code' => 'required|max:20'
        ]);

        Contractor::create($attributes);

        return redirect('/contractors')->with('success', 'Poprawnie dodano nowego  kontrahenta!');
    }

}
