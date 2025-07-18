<?php

namespace App\Http\Controllers;

use App\Http\Requests\DataJadwalRequest;
use App\Models\DataJadwal;
use App\Models\NotarisDetail;
use App\Repositories\Interfaces\DataJadwalRepositoryInterface;
use App\Services\RedirectWithNotification;
use Carbon\Carbon;
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

        $dataJadwal = $dataJadwal->map(function ($jadwal) {
            $jadwal->waktu_mulai = Carbon::createFromFormat('H:i:s', $jadwal->waktu_mulai)->format('H:i');
            $jadwal->waktu_selesai = Carbon::createFromFormat('H:i:s', $jadwal->waktu_selesai)->format('H:i');
            return $jadwal;
        });

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

    public function update(DataJadwalRequest $req)
    {
        $data = $req->validated();
        $update = $this->repository->update($req['id_jadwal'], $data);

        return RedirectWithNotification::back(
            $update,
            'Berhasil update jadwal : ' . $req['tanggal'],
            'Gagal update jadwal : ' . $req['tanggal'],
        );
    }

    public function delete(DataJadwalRequest $req)
    {
        $delete = $this->repository->delete($req['id_jadwal']);

        return RedirectWithNotification::back(
            $delete,
            'Berhasil hapus jadwal : ' . $req['tanggal'],
            'Gagal hapus jadwal : ' . $req['tanggal'],
        );
    }
}
