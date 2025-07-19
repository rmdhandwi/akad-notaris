<?php

namespace App\Http\Controllers;

use App\Http\Requests\DataPihakRequest;
use App\Models\DataJadwal;
use App\Models\JenisLayanan;
use App\Models\KategoriLayanan;
use App\Models\PermintaanLayanan;
use App\Repositories\Interfaces\DataPihakRepositoryInterface;
use App\Services\RedirectWithNotification;
use Illuminate\Http\Request;
use Inertia\Inertia;

class KlienController extends Controller
{
    // repository
    protected $repository;

    public function __construct(DataPihakRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

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
        $dataKategoriLayanan = KategoriLayanan::select('id_kategori','nama_kategori','deskripsi_kategori')->with([
            'jenisLayanan:id_jenis,id_kategori,nama_jenis',
            'jenisLayanan.kategoriPihak:id_kategori_pihak,id_jenis,nama_kategori_pihak',
            'jenisLayanan.kategoriPihak.dataBerkas:id_berkas,id_kategori_pihak,nama_berkas',
        ])->get();

        return Inertia::render('Klien/JenisLayanan/Index', [
            'dataKategoriLayanan' => $dataKategoriLayanan,
        ]);
    }

    public function storeDataPihak(DataPihakRequest  $req)
    {
        $user = auth()->user();

        $data = $req->validated();

        $store = $this->repository->storeDataPihak($user->user_id, $data);

        return redirect()->route('klien.layanan.permintaan.form')->with([
            'id_permintaan' => $store,
            'notif_status' => $store ? 'success' : 'error',
            'notif_message' => $store ? 'Berhasil menyimpan data pihak' : 'Gagal menyimpan data pihak ',
            'notif_duration' => 5000,
        ]);
    }

    public function redirectToFormBerkasPihak(Request $id_permintaan)
    {
        $dataPermintaan = PermintaanLayanan::select('id_permintaan','id_jenis','id_pihak','id_jadwal','tgl_permintaan')->with([
            'jenisLayanan:id_jenis,nama_jenis',
            'jenisLayanan.kategoriPihak:id_kategori_pihak,id_jenis,nama_kategori_pihak',
            'jenisLayanan.kategoriPihak.dataBerkas:id_berkas,id_kategori_pihak,nama_berkas',
        ])->where('id_permintaan', $id_permintaan)->firstOrFail();

        return Inertia::render('Klien/JenisLayanan/FormPermintaan', [
            'dataPermintaan' => $dataPermintaan,
        ]);
    }
}
