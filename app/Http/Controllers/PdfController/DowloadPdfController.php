<?php

namespace App\Http\Controllers\PdfController;

use App\Models\Driver;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DowloadPdfController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function driverPdfDowload()
    {
        $query = Driver::with('city')->get();
        $pdf = \PDF::LoadView('pdf.driverPdf',compact('query'));
        return $pdf->download();
    }
}
