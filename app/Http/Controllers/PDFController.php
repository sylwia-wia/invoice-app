<?php

namespace App\Http\Controllers;

use App\Models\BusinessDocument;
use Illuminate\Http\Request;
use App\Models\Contractor;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function generatePDF($id)
    {
        $businessDocument = BusinessDocument::findOrFail($id);

        $pdf = PDF::loadView('documentPDF', compact('businessDocument'));
        return $pdf->stream('faktura.pdf');
//    return view('documentPDF', ['businessDocument' => $businessDocument]);
    }
}
