<?php
namespace App\Services;

use App\Repositories\BaseRepositoryInterface2;

class BaseService
{
    protected BaseRepositoryInterface2 $repository;

    public function getAll(array $options = [])
    {
        return $this->repository->get(['*'], $options);
    }

    public function find(int|string $id)
    {
        return $this->repository->find($id);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update(int|string $id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete(int|string $id)
    {
        return $this->repository->delete($id);
    }
}