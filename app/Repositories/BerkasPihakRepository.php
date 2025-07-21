<?php

namespace App\Repositories;

use App\Models\BerkasPihak;
use App\Models\PermintaanLayanan;
use App\Repositories\Interfaces\BerkasPihakRepositoryInterface;
use Illuminate\Support\Str;

class BerkasPihakRepository implements BerkasPihakRepositoryInterface
{
    public function create(array $data): bool
    {
        foreach ($data['berkas'] as $listBerkas) {
            foreach ($listBerkas as $berkas) {
                $idPermintaan = $data['id_permintaan']; // ini diambil dari request
                $namaFile = Str::slug($berkas['nama_berkas']) . '.' . $berkas['file']->getClientOriginalExtension();

                $path = $berkas['file']->storeAs(
                    "permintaan/{$idPermintaan}/", // direktori tujuan
                    $namaFile,                         // nama file
                    'public'                           // disk
                );

                BerkasPihak::create([
                    'id_permintaan' => $idPermintaan,
                    'id_pihak' => $berkas['id_pihak'],
                    'id_berkas' => $berkas['id_berkas'],
                    'nama_berkas' => $berkas['nama_berkas'],
                    'berkas_path' => $path,
                    'status' => 'pending',
                ]);
            }
        }
        $updatePermintaan = PermintaanLayanan::findOrFail($data['id_permintaan']);
        $update = $updatePermintaan->update([
            'id_jadwal' => $data['id_jadwal'],
        ]);
        return (bool) $update;
    }

    public function update($id, array $data)
    {
        $getData = BerkasPihak::findOrFail($id);

        return $getData->update($data);
    }

    public function delete($id)
    {
        $getData = BerkasPihak::findOrFail($id);

        return $getData->delete();
    }
}
