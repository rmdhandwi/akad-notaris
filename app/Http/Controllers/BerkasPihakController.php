<?php

namespace App\Http\Controllers;

use App\Http\Requests\BerkasPihakRequest;
use App\Repositories\Interfaces\BerkasPihakRepositoryInterface;
use App\Services\RedirectWithNotification;
use Illuminate\Http\Request;

class BerkasPihakController extends Controller
{
    // repository
    protected $repository;

    public function __construct(BerkasPihakRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function store(BerkasPihakRequest $req)
    {
        $data = $req->validated();

        $store = $this->repository->create($data);

        return RedirectWithNotification::toNamedRoute(
            'klien.permintaan.index',
            $store,
            'Berhasil upload berkas layanan',
            '',
        );
    }
}
