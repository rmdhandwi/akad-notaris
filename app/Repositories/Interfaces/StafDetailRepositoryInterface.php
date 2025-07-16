<?php

namespace App\Repositories\Interfaces;

interface StafDetailRepositoryInterface
{
    public function createWithDetails(array $data);
    public function update($id, array $data);
    public function delete($id);
}
