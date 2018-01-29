<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    public function get($columns = ['*']);

    public function all();

    public function find($id, $columns = ['*']);

    public function findByField($field, $value);

    public function findWhere(array $where);

    public function paginate($limit = null, $columns = ['*']);

    public function create(array $attributes);

    public function update(array $attributes, $id);

    public function delete($id);

    public function with($relations);

    public function orderBy($column, $option = 'asc');

    public function take($limit);
}
