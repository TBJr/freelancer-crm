<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function generateInvoicePDF(Invoice $invoice)
    {
        // Load the related items and customer for the invoice
        $invoice->load('items', 'customer');

        // Generate the PDF with a Blade view
        $pdf = Pdf::loadView('pdf.invoice', compact('invoice'))->setPaper('a4', 'portrait');


        // Return the PDF as a download
        return $pdf->download('invoice-' . $invoice->id . '.pdf');
    }
}
