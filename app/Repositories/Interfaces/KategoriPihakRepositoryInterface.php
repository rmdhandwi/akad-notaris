<?php

namespace App\Repositories\Interfaces;

interface KategoriPihakRepositoryInterface
{
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
