<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class KlienController extends Controller
{
    public function index()
    {
        return Inertia::render('Klien/Dashboard');
    }
}
