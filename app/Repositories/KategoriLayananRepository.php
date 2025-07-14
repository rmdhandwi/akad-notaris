<?php

namespace App\Repositories;

use App\Models\KategoriLayanan;
use App\Repositories\Interfaces\KategoriLayananRepositoryInterface;

class KategoriLayananRepository implements KategoriLayananRepositoryInterface
{
    public function create(array $data) : bool {
        $store = KategoriLayanan::create($data);
        return (bool) $store;
    }
    public function update($id, array $data) {}
    public function delete($id) {}
}
