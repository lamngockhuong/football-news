<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    public function get($columns = ['*']);

    public function all($columns = ['*']);

    public function find($id, $columns = ['*']);

    public function findByField($field, $value);

    public function findWhere(array $where);

    public function orWhere($column, $operator = null, $value = null);

    public function orWhereIn($column, $values);

    public function where($condition, $operator = null, $value = null);

    public function whereBetween($colunm, $values);

    public function whereNotIn($colunm, $values);

    public function whereNull($colunm);

    public function whereNotNull($colunm);

    public function whereHas($relations, $function);

    public function orWhereHas($relations, $function);

    public function paginate($limit = null, $columns = ['*']);

    public function create(array $attributes);

    public function update(array $attributes, $id);

    public function delete($id);

    public function with($relations);

    public function orderBy($column, $option = 'asc');

    public function take($limit);
}
