<?php

namespace App\Http\Controllers;

use App\Http\Requests\JenisLayananRequest;
use App\Models\JenisLayanan;
use App\Models\KategoriLayanan;
use App\Repositories\Interfaces\JenisLayananRepositoryInterface;
use App\Services\RedirectWithNotification;
use Inertia\Inertia;

class JenisLayananController extends Controller
{
    // repository
    protected $repository;

    public function __construct(JenisLayananRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $dataKtg = KategoriLayanan::select('id_kategori', 'nama_kategori')->get();

        $dataJenis = JenisLayanan::select('id_jenis','id_kategori','nama_jenis','deskripsi_jenis')->with([
            'kategoriLayanan:id_kategori,nama_kategori'
        ])->get();

        return Inertia::render('Admin/JenisLayanan/Index', [
            'dataKtg' => $dataKtg,
            'dataJenis' => $dataJenis,
        ]);
    }

    public function store(JenisLayananRequest $req)
    {
        $data = $req->validated();

        $create = $this->repository->create($data);

        return RedirectWithNotification::back(
            $create,
            'Berhasil menambahkan ' . $req['nama_jenis'],
            'Gagal menambahkan ' . $req['nama_jenis'],
        );
    }

    public function update(JenisLayananRequest $req)
    {
        $data = $req->validated();

        $update = $this->repository->update($req['id_jenis'], $data);

        return RedirectWithNotification::back(
            $update,
            'Berhasil update ' . $req['nama_jenis'],
            'Gagal update ' . $req['nama_jenis'],
        );
    }

    public function delete(JenisLayananRequest $req)
    {
        $delete = $this->repository->delete($req['id_jenis']);

        return RedirectWithNotification::back(
            $delete,
            'Berhasil hapus ' . $req['nama_jenis'],
            'Gagal hapus ' . $req['nama_jenis'],
        );
    }
}
