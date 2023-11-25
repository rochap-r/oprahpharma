<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
      return view("index");
    }
}
