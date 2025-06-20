<?php

namespace App\Repositories\Contracts;

use App\Repositories\BaseRepositoryInterface;

interface CategoryRepositoryInterface  extends BaseRepositoryInterface
{
    public function getByName(string $name);
}