<?php

namespace App\Repositories\Eloquent;

use Exception;
use App\Exception\RepositoryException;
use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Container\Container;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements RepositoryInterface
{
    protected $app;

    protected $model;

    public function __construct(Container $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    abstract public function getModel();

    public function get($columns = ['*'])
    {
        $model = $this->model->get($columns);
        $this->makeModel();

        return $model;
    }

    public function all($columns = ['*'])
    {
        if ($this->model instanceof Builder) {
            $model = $this->model->get($columns);
        } else {
            $model = $this->model->all($columns);
        }
        $this->resetModel();

        return $model;
    }

    public function find($id, $columns = ['*'])
    {
        try {
            $model = $this->model->findOrFail($id, $columns);
            $this->resetModel();

            return $model;
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }

    public function findByField($field, $value = null)
    {
        $this->model = $this->model->where($field, '=', $value);

        return $this;
    }

    public function findWhere(array $where)
    {
        $this->applyConditions($where);

        return $this;
    }

    public function orWhere($column, $operator = null, $value = null)
    {
        $this->model = $this->model->orWhere($column, $operator, $value);

        return $this;
    }

    public function orWhereIn($column, $values)
    {
        $values = is_array($values) ? $values : [$values];
        $this->model = $this->model->orWhereIn($column, $values);

        return $this;
    }

    public function where($condition, $operator = null, $value = null)
    {
        $this->model = $this->model->where($condition, $operator, $value);

        return $this;
    }

    public function whereBetween($colunm, $values)
    {
        $this->model = $this->model->whereBetween($colunm, $values);

        return $this;
    }

    public function whereNotIn($colunm, $values)
    {
        $this->model = $this->model->whereNotIn($colunm, $values);

        return $this;
    }

    public function whereNull($colunm)
    {
        $this->model = $this->model->whereNull($colunm);

        return $this;
    }

    public function whereNotNull($colunm)
    {
        $this->model = $this->model->whereNotNull($colunm);

        return $this;
    }

    public function whereHas($relations, $function)
    {
        $this->model = $this->model->whereHas($relations, $function);

        return $this;
    }

    public function orWhereHas($relations, $function)
    {
        $this->model = $this->model->orWhereHas($relations, $function);

        return $this;
    }

    public function paginate($limit = null, $columns = ['*'])
    {
        $limit = is_null($limit) ? config('repository.pagination.limit') : $limit;
        $model = $this->model->paginate($limit, $columns);
        $this->resetModel();

        return $model;
    }

    public function create(array $attributes)
    {
        $model = $this->model->create($attributes);
        $this->resetModel();

        return $model;
    }

    public function update(array $attributes, $model)
    {
        if (!$model instanceof Model) {
            throw new RepositoryException('Class ' . $this->model() . ' must be an instance of Illuminate\Database\Eloquent\Model');
        }

        return $model->update($attributes);
    }

    public function delete($id)
    {
        $model = $this->model->destroy($id);
        $this->resetModel();

        return $model;
    }

    public function with($relations)
    {
        $this->model = $this->model->with($relations);

        return $this;
    }

    public function orderBy($column, $option = 'asc')
    {
        $this->model = $this->model->orderBy($column, $option);

        return $this;
    }

    public function take($limit)
    {
        $this->model = $this->model->take($limit);

        return $this;
    }

    public function makeModel()
    {
        $model = $this->app->make($this->getModel());

        if (!$model instanceof Model) {
            throw new RepositoryException('Class ' . $this->model() . ' must be an instance of Illuminate\Database\Eloquent\Model');
        }
        
        return $this->model = $model;
    }

    public function resetModel()
    {
        $this->makeModel();
    }

    protected function applyConditions(array $where)
    {
        foreach ($where as $field => $value) {
            if (is_array($value)) {
                list($field, $condition, $val) = $value;
                $this->model = $this->model->where($field, $condition, $val);
            } else {
                $this->model = $this->model->where($field, '=', $value);
            }
        }
    }
}
