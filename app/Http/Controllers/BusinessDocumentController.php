<?php

namespace App\Http\Controllers;

use App\Exceptions\BusinessDocumentException;
use App\Http\Requests\BusinessDocumentRequest;
use App\Models\{BusinessDocument, Contractor, DocumentPosition, DocumentType, Product, Unit, VatRate};
use App\Services\BusinessDocumentService;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        return view('business_documents.create',
            $this->prepareAdditionalData());
    }

    public function store(BusinessDocumentRequest $request, BusinessDocumentService $service): RedirectResponse
    {
        $attributes = $request->validated();


        try {
            $service->create($attributes);
        } catch (BusinessDocumentException $e) {
            return redirect()->route('business_documents.create')->with('error', $e->getMessage());
        }

        return redirect('/business_documents')->with('success', 'Poprawnie dodano dokument!');
    }

    public function show($id): View
    {
        $businessDocument = BusinessDocument::with('contractor', 'documentType')->findOrFail($id);

        return view('business_documents.show', [
            'business_document' => $businessDocument,
        ]);
    }

    public function edit($id): View
    {
        $businessDocument = BusinessDocument::with('contractor', 'documentType')->findOrFail($id);

        return view('business_documents.edit', array_merge([
            'businessDocument' => $businessDocument,
        ], $this->prepareAdditionalData()));
    }


    public function update(BusinessDocumentRequest $request, BusinessDocumentService $service, $id): RedirectResponse
    {
        $attributes = $request->validated();

        try {
            $service->update($attributes, $id);
        } catch (BusinessDocumentException $e) {
            return redirect()->route('business_documents.edit')->with('error', $e->getMessage());
        }

        return redirect('/business_documents')->with('success', 'Poprawnie edytowano dokument');
    }

    public function destroy()
    {

    }

    protected function prepareAdditionalData(): array
    {
        $documentTypes = DocumentType::all();
        $contractors = Contractor::all();
        $products = Product::all();
        $vatRates = VatRate::all();
        $units = Unit::all();

        return [
            'documentTypes' => $documentTypes,
            'contractors' => $contractors,
            'products' => $products,
            'vatRates' => $vatRates,
            'units' => $units,
        ];
    }
}
