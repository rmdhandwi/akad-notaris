<?php

namespace App\Http\Controllers;

use App\Models\DataJadwal;
use Inertia\Inertia;

class KlienController extends Controller
{
    public function dashboard()
    {
        return Inertia::render('Klien/Dashboard');
    }

    public function indexJadwal()
    {
        $dataJadwal = DataJadwal::where('alasan', NULL)->select('id_jadwal', 'notaris_id', 'tanggal', 'waktu_mulai', 'waktu_selesai', 'alasan')->with([
            'notaris:notaris_id,nomor_jabatan_notaris,nama_notaris'
        ])->get();

        return Inertia::render('Klien/Jadwal/Index', [
            'dataJadwal' => $dataJadwal,
        ]);
    }
}
