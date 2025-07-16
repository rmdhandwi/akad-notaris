<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotarisDetailRequest;
use App\Models\User;
use App\Repositories\Interfaces\NotarisDetailRepositoryInterface;
use App\Services\RedirectWithNotification;
use Inertia\Inertia;

class NotarisDetailController extends Controller
{
    // repository
    protected $repository;

    public function __construct(NotarisDetailRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $dataNotaris = User::where('role_id', 3)->select('user_id', 'username', 'email')->with([
            'NotarisDetails:notaris_id,user_id,nomor_jabatan_notaris,nama_notaris'
        ])->get();

        return Inertia::render('Admin/DataNotaris/Index', [
            'dataNotaris' => $dataNotaris,
        ]);
    }

    public function store(NotarisDetailRequest $req)
    {
        $data = $req->validated();

        $create = $this->repository->createWithDetails($data);

        return RedirectWithNotification::back(
            $create,
            'Berhasil menambahkan notaris : ' . $req['notaris_details.nama_notaris'],
            'Gagal menambahkan notaris : ' . $req['notaris_details.nama_notaris'],
        );
    }

    public function update(NotarisDetailRequest $req)
    {
        $data = $req->validated();

        $update = $this->repository->update($req['user_id'], $data);

        return RedirectWithNotification::back(
            $update,
            'Berhasil update notaris : ' . $req['notaris_details.nama_notaris'],
            'Gagal update notaris : ' . $req['notaris_details.nama_notaris'],
        );
    }

    public function delete(NotarisDetailRequest $req)
    {
        $delete = $this->repository->delete($req['user_id']);

        return RedirectWithNotification::back(
            $delete,
            'Berhasil hapus notaris : ' . $req['notaris_details.nama_notaris'],
            'Gagal hapus notaris : ' . $req['notaris_details.nama_notaris'],
        );
    }
}
