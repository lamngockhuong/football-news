<?php

namespace App\Repositories\Eloquent;

use Exception;
use App\Exception\RepositoryException;
use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Contracts\Container\Container;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements RepositoryInterface
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @var model
     */
    protected $model;

    public function __construct(Container $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    abstract public function getModel();

    public function get()
    {
        $model = $this->model->get();
        $this->makeModel();

        return $model;
    }

    /**
     * Retrieve all data of repository
     * @return \Illuminate\Support\Collection|array
     */
    public function all()
    {
        $model = $this->model->all();
        $this->resetModel();

        return $model;
    }

    /**
     * Find data by id
     *
     * @param $id
     *
     * @return mixed
     */
    public function find($id)
    {
        try {
            $model = $this->model->findOrFail($id);
            $this->resetModel();

            return $model;
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }

    /**
     * Find data by field and value
     *
     * @param $field
     * @param $value
     *
     * @return mixed
     */
    public function findByField($field, $value = null)
    {
        return $this->model->where($field, '=', $value);
    }

    /**
     * Find data by multiple fields
     *
     * @param array $where
     *
     * @return mixed
     */
    public function findWhere(array $where)
    {
        $this->applyConditions($where);

        return $this;
    }

    /**
     * Retrieve all data of repository, paginated
     */
    public function paginate($limit = null)
    {
        $limit = is_null($limit) ? config('repository.pagination.limit') : $limit;
        $model = $this->model->paginate($limit);
        $this->resetModel();

        return $model;
    }

    /**
     * Save a new entity in repository
     *
     * @param array $attributes
     *
     * @return mixed
     */
    public function create(array $attributes)
    {
        $model = $this->model->create($attributes);
        $this->resetModel();

        return $model;
    }

    /**
     * Update a entity in repository by id
     *
     * @param array $attributes
     * @param       $id
     *
     * @return mixed
     */
    public function update(array $attributes, $model)
    {
        if (!$model instanceof Model) {
            throw new RepositoryException('Class ' . $this->model() . ' must be an instance of Illuminate\Database\Eloquent\Model');
        }

        return $model->update($attributes);
    }

    /**
     * Delete a entity in repository by id
     *
     * @param $id
     *
     * @return int
     */
    public function delete($id)
    {
        $model = $this->model->destroy($id);
        $this->resetModel();

        return $model;
    }

    /**
     * @return Model
     * @throws RepositoryException
     */
    public function makeModel()
    {
        $model = $this->app->make($this->getModel());

        if (!$model instanceof Model) {
            throw new RepositoryException('Class ' . $this->model() . ' must be an instance of Illuminate\Database\Eloquent\Model');
        }
        
        return $this->model = $model;
    }

    /**
     * @throws RepositoryException
     */
    public function resetModel()
    {
        $this->makeModel();
    }

    /**
     * Applies the given where conditions to the model.
     *
     * @param array $where
     * @return void
     */
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
