<?php

namespace App\Repositories;

use App\Models\DataPihak;
use App\Repositories\Interfaces\DataPihakRepositoryInterface;

class DataPihakRepository implements DataPihakRepositoryInterface
{
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
