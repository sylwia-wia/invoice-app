<?php

namespace App\Http\Controllers;

use App\Models\BusinessDocument;
use Illuminate\Http\Request;

class BusinessDocumentController extends Controller
{
    public function index()
    {
        $businessDocuments = BusinessDocument::with('contractor', 'documentType')->get();
        return view('business_documents',
            [
                'business_documents' => $businessDocuments
            ]);
    }
}
