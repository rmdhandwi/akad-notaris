<?php

namespace App\Repositories;

use App\Models\StafDetail;
use App\Repositories\Interfaces\StafDetailRepositoryInterface;

class StafDetailRepository implements StafDetailRepositoryInterface
{
    public function create(array $data): bool
    {
        $store = StafDetail::create($data);
        return (bool) $store;
    }

    public function update($id, array $data)
    {
        $getData = StafDetail::findOrFail($id);

        return $getData->update($data);
    }

    public function delete($id)
    {
        $getData = StafDetail::findOrFail($id);

        return $getData->delete();
    }
}
