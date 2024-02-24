<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('apps.orders.index');
    }

    public function register()
    {
        return view('apps.orders.register');
    }
}
