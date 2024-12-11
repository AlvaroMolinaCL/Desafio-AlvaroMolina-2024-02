<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Muestra el dashboard principal.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('dashboard.index');
    }
}
