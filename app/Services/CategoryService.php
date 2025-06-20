<?php
namespace App\Services;

use App\Repositories\Contracts\CategoryRepositoryInterface;

Class CategoryService
{
    protected $repo;

    public function __construct(CategoryRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function getAll() { return $this->repo->all(); }
    public function getById($id) { return $this->repo->find($id); }
    public function create($data) { return $this->repo->create($data); }
    public function update($id, $data) { return $this->repo->update($id, $data); }
    public function delete($id) { return $this->repo->delete($id); }
    public function getByName($name) { return $this->repo->getByName($name); }
}