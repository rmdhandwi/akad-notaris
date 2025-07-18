<?php

namespace App\Http\Controllers;

use App\Models\KategoriPihak;
use Illuminate\Http\Request;
use Inertia\Inertia;

class KategoriPihakController extends Controller
{
    public function index()
    {
        $dataKtgPihak = KategoriPihak::select('id_kategori_pihak', 'nama_kategori_pihak')->get();
        return Inertia::render('Admin/KategoriPihak/Index', [
            'dataKtgPihak' => $dataKtgPihak,
        ]);
    }
}
