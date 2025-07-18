<?php

namespace App\Repositories\Interfaces;

interface DataPihakRepositoryInterface
{
    public function create(array $data);
    public function storeDataPihak(int $userIdPihak1, array $data);
    public function update($id, array $data);
    public function delete($id);
}
