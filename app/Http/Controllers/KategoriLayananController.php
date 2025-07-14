<?php

namespace App\Http\Controllers;

use App\Http\Requests\KategoriLayananRequest;
use App\Models\KategoriLayanan;
use App\Repositories\Interfaces\KategoriLayananRepositoryInterface;
use App\Services\RedirectWithNotification;
use Inertia\Inertia;

class KategoriLayananController extends Controller
{
    // repository
    protected $repository;

    public function __construct(KategoriLayananRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $data = KategoriLayanan::select('id_kategori','nama_kategori','deskripsi_kategori')->get();

        return Inertia::render('Admin/KategoriLayanan/Index',[
            'data' => $data,
        ]);
    }

    public function store(KategoriLayananRequest $req)
    {
        $data = $req->validated();

        $create = $this->repository->create($data);

        return RedirectWithNotification::back(
            $create,
            'Berhasil menambahkan '.$req['nama_kategori'],
            'Gagal menambahkan '.$req['nama_kategori'],
        );
    }
}
