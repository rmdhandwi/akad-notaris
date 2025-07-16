<?php

namespace App\Repositories;

use App\Models\DataBerkas;
use App\Repositories\Interfaces\DataBerkasRepositoryInterface;

class DataBerkasRepository implements DataBerkasRepositoryInterface
{
    public function create(array $data): bool
    {
        $store = DataBerkas::create($data);
        return (bool) $store;
    }

    public function update($id, array $data)
    {
        $getData = DataBerkas::findOrFail($id);

        return $getData->update($data);
    }

    public function delete($id)
    {
        $getData = DataBerkas::findOrFail($id);

        return $getData->delete();
    }
}
