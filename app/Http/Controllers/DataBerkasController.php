<?php

namespace App\Http\Controllers;

use App\Http\Requests\DataBerkasRequest;
use App\Models\DataBerkas;
use App\Models\JenisLayanan;
use App\Repositories\Interfaces\DataBerkasRepositoryInterface;
use App\Services\RedirectWithNotification;
use Inertia\Inertia;

class DataBerkasController extends Controller
{
    // repository
    protected $repository;

    public function __construct(DataBerkasRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $dataJenis = JenisLayanan::select('id_jenis', 'nama_jenis')->get();

        $dataBerkas = DataBerkas::select('id_berkas', 'id_jenis', 'nama_berkas')->with([
            'jenisLayanan:id_jenis,nama_jenis'
        ])->get();

        return Inertia::render('Admin/DataBerkas/Index', [
            'dataBerkas' => $dataBerkas,
            'dataJenis' => $dataJenis,
        ]);
    }

    public function store(DataBerkasRequest $req)
    {
        $data = $req->validated();

        $create = $this->repository->create($data);

        return RedirectWithNotification::back(
            $create,
            'Berhasil menambahkan berkas : ' . $req['nama_berkas'],
            'Gagal menambahkan berkas : ' . $req['nama_berkas'],
        );
    }

    public function update(DataBerkasRequest $req)
    {
        $data = $req->validated();

        $update = $this->repository->update($req['id_berkas'], $data);

        return RedirectWithNotification::back(
            $update,
            'Berhasil update berkas : ' . $req['nama_berkas'],
            'Gagal update berkas : ' . $req['nama_berkas'],
        );
    }

    public function delete(DataBerkasRequest $req)
    {
        $delete = $this->repository->delete($req['id_berkas']);

        return RedirectWithNotification::back(
            $delete,
            'Berhasil hapus berkas : ' . $req['nama_berkas'],
            'Gagal hapus berkas : ' . $req['nama_berkas'],
        );
    }
}
