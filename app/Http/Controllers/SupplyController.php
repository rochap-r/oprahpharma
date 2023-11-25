<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupplyController extends Controller
{
    public function index()
    {
        return view('apps.supply.supply');
    }

    public function product()
    {
        return view('apps.supply.supplyByProduct');
    }
    public function products()
    {
        return view('apps.supply.supplyByProducts');
    }
}
