<?php

namespace App\Repositories;

use App\Models\NotarisDetail;
use App\Repositories\Interfaces\NotarisDetailRepositoryInterface;

class NotarisDetailRepository implements NotarisDetailRepositoryInterface
{
    public function create(array $data): bool
    {
        $store = NotarisDetail::create($data);
        return (bool) $store;
    }

    public function update($id, array $data)
    {
        $getData = NotarisDetail::findOrFail($id);

        return $getData->update($data);
    }

    public function delete($id)
    {
        $getData = NotarisDetail::findOrFail($id);

        return $getData->delete();
    }
}
