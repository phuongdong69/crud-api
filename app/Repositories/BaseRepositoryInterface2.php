<?php

namespace App\Repositories;

interface BaseRepositoryInterface2
{
    public function get(array$colums = ['*'], array $options = []);
    public function find(int|string $id);
    public function create(array $data);
    public function update(int|string $id, array $data);
    public function delete(int|string $id);
}

