<?php

namespace App\Http\Controllers\Afdeling;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.afdeling.dashboard');
    }
}
