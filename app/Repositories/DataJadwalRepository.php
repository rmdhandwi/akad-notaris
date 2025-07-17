<?php

namespace App\Repositories;

use App\Models\DataJadwal;
use App\Repositories\Interfaces\DataJadwalRepositoryInterface;

class DataJadwalRepository implements DataJadwalRepositoryInterface
{
    public function create(array $data): bool
    {
        $store = DataJadwal::create($data);
        return (bool) $store;
    }

    public function update($id, array $data)
    {
        $getData = DataJadwal::findOrFail($id);

        return $getData->update($data);
    }

    public function delete($id)
    {
        $getData = DataJadwal::findOrFail($id);

        return $getData->delete();
    }
}
