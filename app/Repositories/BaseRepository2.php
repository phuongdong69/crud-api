<?php

namespace App\Repositories;

use App\Repositories\BaseRepositoryInterface2 as RepositoriesBaseRepositoryInterface2;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\BaseRepositoryInterface;
use App\Repositories\Contracts\BaseRepositoryInterface2;

// REPOSITORY PATTERNS
// abstract class BaseRepository2 implements BaseRepositoryInterface2
class BaseRepository2 implements RepositoriesBaseRepositoryInterface2
{
    protected Model $model;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    public function get(array $columns = ['*'], array $options = []): Collection|LengthAwarePaginator
    {
        $query = $this->model->newQuery();
        $this->optionBuilder($query, $options);

        $paginate = $options['paginate'] ?? false;
        $perPage = $options['per_page'] ?? 10;

        return $paginate
            ? $query->select($columns)->paginate($perPage)
            : $query->select($columns)->get();
    }
    public function find(int|string $id, array $options = [])
    {
        $query = $this->model->newQuery();
        $this->optionBuilder($query, $options);
        return $query->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int|string $id, array $data, array $options = []): ?Model
{
    $model = $this->model->findOrFail($id);
    $model->update($data);
    // Trả về bản ghi mới nhất, có thể eager load quan hệ nếu cần
    $query = $this->model->newQuery();
    $this->optionBuilder($query, $options);

    return $query->find($id);
}

    public function delete(int|string $id)
    {
        $model = $this->model->findOrFail($id);
        return $model->delete();
    }

    // builder patterns

    protected function optionBuilder(&$query, array $options = [])
    {
        $relations = $options['relations'] ?? [];
        if (!empty($relations)) {
            $query->with($relations);
        }
        foreach ($options['join'] ?? [] as $join) {
            $type = $join['type'] ?? 'inner';
            $query->{$type . 'Join'}(
                $join['table'],
                $join['first'],
                $join['operator'],
                $join['second']
            );
        }

        foreach ($options['filters'] ?? [] as $column => $value) {
            $query->where($column, $value);
        }

        foreach ($options['sort'] ?? [] as $column => $direction) {
            $query->orderBy($column, $direction);
        }
    }
}
