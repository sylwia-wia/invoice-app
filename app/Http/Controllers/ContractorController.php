<?php

namespace App\Http\Controllers;

use App\Models\Contractor;
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
        return view('contractor.create');
    }

}
