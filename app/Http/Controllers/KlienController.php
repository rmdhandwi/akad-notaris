<?php

namespace App\Http\Controllers;

use App\Models\DataJadwal;
use App\Models\JenisLayanan;
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

    public function indexSyaratJenisLayanan()
    {
        $dataJenisLayanan = JenisLayanan::select('id_jenis','id_kategori','nama_jenis')->with([
            'kategoriPihak:id_kategori_pihak,id_jenis,nama_kategori_pihak',
            'kategoriPihak.dataBerkas:id_berkas,id_kategori_pihak,nama_berkas',
        ])->get();

        return Inertia::render('Klien/JenisLayanan/Index', [
            'dataJenisLayanan' => $dataJenisLayanan,
        ]);
    }
}
