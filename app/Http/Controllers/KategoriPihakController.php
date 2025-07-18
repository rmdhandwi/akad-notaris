<?php

namespace App\Http\Controllers;

use App\Http\Requests\KategoriPihakRequest;
use App\Models\JenisLayanan;
use App\Models\KategoriPihak;
use App\Repositories\Interfaces\KategoriPihakRepositoryInterface;
use App\Services\RedirectWithNotification;
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
        $dataJenis = JenisLayanan::select('id_jenis', 'nama_jenis')->get();
        $dataKtgPihak = KategoriPihak::select('id_kategori_pihak','id_jenis', 'nama_kategori_pihak')->with([
            'jenisLayanan:id_jenis,nama_jenis'
        ])->get();
        return Inertia::render('Admin/KategoriPihak/Index', [
            'dataJenis' => $dataJenis,
            'dataKtgPihak' => $dataKtgPihak,
        ]);
    }

    public function store(KategoriPihakRequest $req)
    {
        $data = $req->validated();
        $create = $this->repository->create($data);
        return RedirectWithNotification::back(
            $create,
            'Berhasil menambahkan kategori pihak : ' . $req['nama_kategori_pihak'],
            'Gagal menambahkan kategori pihak : ' . $req['nama_kategori_pihak'],
        );

    }

    public function update(KategoriPihakRequest $req)
    {
        $data = $req->validated();
        $update = $this->repository->update($data['id_kategori_pihak'], $data);
        return RedirectWithNotification::back(
            $update,
            'Berhasil update kategori pihak : ' . $req['nama_kategori_pihak'],
            'Gagal update kategori pihak : ' . $req['nama_kategori_pihak'],
        );
    }

    public function delete(KategoriPihakRequest $req)
    {
        $delete = $this->repository->delete($req['id_kategori_pihak']);

        return RedirectWithNotification::back(
            $delete,
            'Berhasil hapus kategori pihak : ' . $req['nama_kategori_pihak'],
            'Gagal hapus kategori pihak : ' . $req['nama_kategori_pihak'],
        );
    }
}
