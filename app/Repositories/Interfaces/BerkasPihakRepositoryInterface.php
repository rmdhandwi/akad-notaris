<?php

namespace App\Repositories\Interfaces;

interface BerkasPihakRepositoryInterface
{
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
