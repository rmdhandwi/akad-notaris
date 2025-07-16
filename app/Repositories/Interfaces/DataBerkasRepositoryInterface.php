<?php

namespace App\Repositories\Interfaces;

interface DataBerkasRepositoryInterface
{
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
