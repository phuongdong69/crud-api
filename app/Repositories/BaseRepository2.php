<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\BaseRepositoryInterface;

abstract class BaseRepository2 implements BaseRepositoryInterface2
{
    protected Model $model;
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
    public function find(int|string $id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int|string $id, array $data)
{
    $model = $this->model->findOrFail($id);
    $model->update($data);
    // Trả về bản ghi mới nhất, có thể eager load quan hệ nếu cần
    return $this->model->with('category', 'product_variants.product_variant_values.attribute_value.attribute')->find($id);
}

    public function delete(int|string $id)
    {
        $model = $this->model->findOrFail($id);
        return $model->delete();
    }

    protected function optionBuilder(&$query, array $options = [])
    {
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