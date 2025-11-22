<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ReturnTypeWillChange;

class DashboardController extends Controller
{
    //
    public function index()
    {
        return view('dashboard.dashboard');
    }
}
