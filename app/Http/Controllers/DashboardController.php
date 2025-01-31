<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function indexPage()
    {
        return view('include.backend.dashboard');
    }
}
