<?php

namespace App\Repositories\Eloquent;

use Exception;
use App\Exception\RepositoryException;
use App\Repositories\Contracts\RepositoryInterface;
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

    public function all()
    {
        $model = $this->model->all();
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
