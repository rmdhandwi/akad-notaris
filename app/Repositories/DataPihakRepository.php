<?php

namespace App\Repositories;

use App\Models\DataPihak;
use App\Models\PermintaanLayanan;
use App\Repositories\Interfaces\DataPihakRepositoryInterface;
use Illuminate\Support\Facades\DB;

class DataPihakRepository implements DataPihakRepositoryInterface
{
    public function storeDataPihak(int $userIdPihak1, array $data)
    {
        return DB::transaction(function () use ($data, $userIdPihak1) {
            // Pihak pertama
            $pihak1 = new DataPihak([
                'user_id' => $userIdPihak1,
                'id_kategori_pihak' => $data['pihak'][0]['id_kategori_pihak'],
                'nama_pihak' => $data['pihak'][0]['nama_pihak'],
                'nik_pihak' => $data['pihak'][0]['nik_pihak'],
                'no_hp_pihak' => $data['pihak'][0]['no_hp_pihak'],
                'alamat_pihak' => $data['pihak'][0]['alamat_pihak'],
                'tipe_pihak' => $data['pihak'][0]['tipe_pihak'],
            ]);
            $pihak1->save();

            // Pihak kedua
            $pihak2 = new DataPihak([
                'user_id' => null,
                'id_pihak_terkait' => $pihak1->id_pihak,
                'id_kategori_pihak' => $data['pihak'][1]['id_kategori_pihak'],
                'nama_pihak' => $data['pihak'][1]['nama_pihak'],
                'nik_pihak' => $data['pihak'][1]['nik_pihak'],
                'no_hp_pihak' => $data['pihak'][1]['no_hp_pihak'],
                'alamat_pihak' => $data['pihak'][1]['alamat_pihak'],
                'tipe_pihak' => $data['pihak'][1]['tipe_pihak'],
            ]);
            $pihak2->save();

            // Simpan permintaan
            $permintaan = PermintaanLayanan::create([
                'id_jenis' => $data['id_jenis'],
                'id_pihak' => $pihak1->id_pihak,
                'tgl_permintaan' => now(),
            ]);

            return $permintaan->id_permintaan;
        });
    }

    public function create(array $data): bool
    {
        $store = DataPihak::create($data);
        return (bool) $store;
    }

    public function update($id, array $data)
    {
        $getData = DataPihak::findOrFail($id);

        return $getData->update($data);
    }

    public function delete($id)
    {
        $getData = DataPihak::findOrFail($id);

        return $getData->delete();
    }
}
