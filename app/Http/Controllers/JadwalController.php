<?php

namespace App\Http\Controllers;

use App\Models\DataJadwal;
use App\Models\NotarisDetail;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JadwalController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $notarisDetail = NotarisDetail::where('user_id', $user->user_id)->first();

        $dataJadwal = DataJadwal::where('notaris_id', $notarisDetail->notaris_id)->get(['id_jadwal','notaris_id','tanggal','waktu_mulai','waktu_selesai']);

        return Inertia::render('Notaris/Jadwal/Index', [
            'dataJadwal' => $dataJadwal,
        ]);
    }
}
