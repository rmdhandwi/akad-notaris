<?php

namespace App\Http\Controllers;

use App\Http\Requests\DataJadwalRequest;
use App\Models\DataJadwal;
use App\Models\NotarisDetail;
use App\Repositories\Interfaces\DataJadwalRepositoryInterface;
use App\Services\RedirectWithNotification;
use Inertia\Inertia;

class JadwalController extends Controller
{
    // repository
    protected $repository;

    public function __construct(DataJadwalRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $user = auth()->user();

        $notarisDetails = NotarisDetail::where('user_id', $user->user_id)->first();

        $dataJadwal = DataJadwal::where('notaris_id', $notarisDetails->notaris_id)->get(['id_jadwal','notaris_id','tanggal','waktu_mulai','waktu_selesai','alasan']);

        return Inertia::render('Notaris/Jadwal/Index', [
            'dataJadwal' => $dataJadwal,
        ]);
    }

    public function store(DataJadwalRequest $req)
    {
        $data = $req->validated();
        $create = $this->repository->create($data);

        return RedirectWithNotification::back(
            $create,
            'Berhasil menambahkan jadwal : ' . $req['tanggal'],
            'Gagal menambahkan jadwal : ' . $req['tanggal'],
        );
    }
}
