<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class KlienController extends Controller
{
    public function dashboard()
    {
        return Inertia::render('Klien/Dashboard');
    }
}
