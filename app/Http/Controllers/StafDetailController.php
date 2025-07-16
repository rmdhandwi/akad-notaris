<?php

namespace App\Http\Controllers;

use App\Http\Requests\StafDetailRequest;
use App\Models\User;
use App\Repositories\Interfaces\StafDetailRepositoryInterface;
use App\Services\RedirectWithNotification;
use Inertia\Inertia;

class StafDetailController extends Controller
{
    // repository
    protected $repository;

    public function __construct(StafDetailRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $dataStaf = User::where('role_id', 2)->select('user_id', 'username', 'email')->with([
            'stafDetails:staf_id,user_id,nik_staf,nama_staf'
        ])->get();

        return Inertia::render('Admin/DataStaf/Index', [
            'dataStaf' => $dataStaf,
        ]);
    }

    public function store(StafDetailRequest $req)
    {
        $data = $req->validated();

        $create = $this->repository->createWithDetails($data);

        return RedirectWithNotification::back(
            $create,
            'Berhasil menambahkan staf : ' . $req['staf_details.nama_staf'],
            'Gagal menambahkan staf : ' . $req['staf_details.nama_staf'],
        );
    }

    public function update(StafDetailRequest $req)
    {
        $data = $req->validated();

        $update = $this->repository->update($req['user_id'], $data);

        return RedirectWithNotification::back(
            $update,
            'Berhasil update staf : ' . $req['staf_details.nama_staf'],
            'Gagal update staf : ' . $req['staf_details.nama_staf'],
        );
    }

    public function delete(StafDetailRequest $req)
    {
        $delete = $this->repository->delete($req['user_id']);

        return RedirectWithNotification::back(
            $delete,
            'Berhasil hapus staf : ' . $req['staf_details.nama_staf'],
            'Gagal hapus staf : ' . $req['staf_details.nama_staf'],
        );
    }
}
