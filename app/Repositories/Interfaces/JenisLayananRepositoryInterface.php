<?php

namespace App\Repositories\Interfaces;

interface JenisLayananRepositoryInterface
{
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
