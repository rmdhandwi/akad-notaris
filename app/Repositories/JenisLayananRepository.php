<?php

namespace App\Repositories;

use App\Models\JenisLayanan;
use App\Repositories\Interfaces\JenisLayananRepositoryInterface;

class JenisLayananRepository implements JenisLayananRepositoryInterface
{
    public function create(array $data): bool
    {
        $store = JenisLayanan::create($data);
        return (bool) $store;
    }
    
    public function update($id, array $data)
    {
        $getData = JenisLayanan::findOrFail($id);

        return $getData->update($data);
    }

    public function delete($id)
    {
        $getData = JenisLayanan::findOrFail($id);

        return $getData->delete();
    }
}
