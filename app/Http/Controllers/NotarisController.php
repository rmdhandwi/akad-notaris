<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class NotarisController extends Controller
{
    public function dashboard()
    {
        return Inertia::render('Notaris/Dashboard');
    }
}
