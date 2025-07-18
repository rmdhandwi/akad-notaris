<?php

namespace App\Http\Controllers;

use App\Models\KategoriPihak;
use App\Repositories\Interfaces\KategoriPihakRepositoryInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class KategoriPihakController extends Controller
{
    // repository
    protected $repository;

    public function __construct(KategoriPihakRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $dataKtgPihak = KategoriPihak::select('id_kategori_pihak', 'nama_kategori_pihak')->get();
        return Inertia::render('Admin/KategoriPihak/Index', [
            'dataKtgPihak' => $dataKtgPihak,
        ]);
    }
}
