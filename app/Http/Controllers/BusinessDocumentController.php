<?php

namespace App\Http\Controllers;

use App\Exceptions\BusinessDocumentException;
use App\Http\Requests\BusinessDocumentRequest;
use App\Http\Requests\SettlementRequest;
use App\Models\{BusinessDocument, Contractor, DocumentPosition, DocumentType, Product, Unit, VatRate};
use App\Services\BusinessDocumentService;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use JetBrains\PhpStorm\NoReturn;

class BusinessDocumentController extends Controller
{
    public function index(Request $request): View
    {
        return view('business_documents',
            [
                'business_documents' => BusinessDocument::orderBy('number')->filter(request(['search']))
                ->paginate(20)->withQueryString()
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


    /**
     * @param BusinessDocumentRequest $request
     * @param BusinessDocumentService $service
     * @param $id
     * @return RedirectResponse
     */
    public function update(BusinessDocumentRequest $request, BusinessDocumentService $service, $id): RedirectResponse
    {

        $attributes = $request->validated();


//        try {
            $service->update($attributes, $id);
//        } catch (BusinessDocumentException $e) {
//            return redirect()->route('business_documents.edit')->with('error', $e->getMessage());
//        }

        return redirect()->route('business_documents.index')->with('success', 'Poprawnie edytowano dokument');
    }

    public function destroy()
    {

    }

    public function settlementForm($id) {
        $businessDocument = BusinessDocument::findOrFail($id);

        return view('business_documents/settlement', [
            'business_document' => $businessDocument,
        ]);
    }

    public function settlement($id, SettlementRequest $request) {
        $businessDocument = BusinessDocument::findOrFail($id);
        $attributes = $request->validated();

        if($businessDocument->gross_value >= $businessDocument->gross_settled){
            $businessDocument->gross_settled += $attributes['gross_settled'];
            $businessDocument->save();
        }
        else {
            return redirect()->route('business_documents.index')->with('error', 'Niepoprawna kwota rozliczenia!');
        }

        return redirect()->route('business_documents.index')->with('success', 'Poprawnie rozliczono płatność!');
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
