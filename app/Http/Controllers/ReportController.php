<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('apps.reports.index');
    }

    public function StockReport()
    {
        return view('apps.reports.stock-report');
    }
    public function ExpirationReport()
    {
        return view('apps.reports.expiration-report');
    }
}
