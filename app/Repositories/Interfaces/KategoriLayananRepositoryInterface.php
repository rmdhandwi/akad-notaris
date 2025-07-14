<?php

namespace App\Repositories\Interfaces;

use App\Models\KategoriLayanan;

interface KategoriLayananRepositoryInterface
{
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
