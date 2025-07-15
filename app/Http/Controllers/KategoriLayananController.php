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

    public function update(KategoriLayananRequest $req)
    {
        $data = $req->validated();

        $update = $this->repository->update($req['id_kategori'], $data);

        return RedirectWithNotification::back(
            $update,
            'Berhasil update ' . $req['nama_kategori'],
            'Gagal update ' . $req['nama_kategori'],
        );
    }

    public function delete(KategoriLayananRequest $req)
    {
        $delete = $this->repository->delete($req['id_kategori']);

        return RedirectWithNotification::back(
            $delete,
            'Berhasil hapus ' . $req['nama_kategori'],
            'Gagal hapus ' . $req['nama_kategori'],
        );
    }
}
