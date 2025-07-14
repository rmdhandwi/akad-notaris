<?php

namespace App\Http\Controllers;

use App\Models\KategoriLayanan;
use Illuminate\Http\Request;
use Inertia\Inertia;

class KategoriLayananController extends Controller
{
    public function index()
    {
        $data = KategoriLayanan::select('id_kategori','nama_kategori','deksripsi_kategori')->get();

        return Inertia::render('Admin/KategoriLayanan/Index',[
            'data' => $data,
        ]);
    }
}
