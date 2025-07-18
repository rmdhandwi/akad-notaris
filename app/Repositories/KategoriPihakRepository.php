<?php

namespace App\Repositories;

use App\Models\KategoriPihak;
use App\Repositories\Interfaces\KategoriPihakRepositoryInterface;

class KategoriPihakRepository implements KategoriPihakRepositoryInterface
{
    public function create(array $data) : bool {
        $store = KategoriPihak::create($data);
        return (bool) $store;
    }

    public function update($id, array $data) {
        $getData = KategoriPihak::findOrFail($id);

        return $getData->update($data);
    }

    public function delete($id) {
        $getData = KategoriPihak::findOrFail($id);

        return $getData->delete();
    }
}
