<?php

namespace App\Http\Controllers;

use App\Exceptions\CreateBusinessDocumentException;
use App\Http\Requests\BusinessDocumentRequest;
use App\Models\BusinessDocument;
use App\Models\Contractor;
use App\Models\DocumentPosition;
use App\Models\DocumentType;
use App\Models\Product;
use App\Models\Unit;
use App\Models\VatRate;
use App\Services\CreateBusinessDocumentService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;


class BusinessDocumentController extends Controller
{
    public function index(): View
    {
        $businessDocuments = BusinessDocument::with('contractor', 'documentType')->get();

        return view('business_documents',
            [
                'business_documents' => $businessDocuments
            ]);
    }

    public function create(): View
    {
        $documentsTypes = DocumentType::all();
        $contractors = Contractor::all();
        $products = Product::all();
        $vatRates = VatRate::all();
        $units = Unit::all();


        return view('business_documents.create',
            [
                'documentsTypes' => $documentsTypes,
                'contractors' => $contractors,
                'products' => $products,
                'vatRates' => $vatRates,
                'units' => $units

            ]);
    }

    public function store(BusinessDocumentRequest $request, CreateBusinessDocumentService $service): RedirectResponse
    {
        $attributes = $request->validated();

        try {
            $service->create($attributes);
        } catch (CreateBusinessDocumentException $e) {
            return redirect()->route('business_documents.create')->with('error', $e->getMessage());
        }

        return redirect('/business_documents')->with('success', 'Poprawnie dodano dokument!');
    }

    public function destroy()
    {

    }
}
