<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    public function get();

    /**
     * Retrieve all data of repository
     * @return \Illuminate\Support\Collection|array
     */
    public function all();

    /**
     * Find data by id
     *
     * @param $id
     *
     * @return mixed
     */
    public function find($id);


    /**
     * Find data by field and value
     *
     * @param $field
     * @param $value
     *
     * @return mixed
     */
    public function findByField($field, $value);

    /**
     * Find data by multiple fields
     *
     * @param array $where
     *
     * @return mixed
     */
    public function findWhere(array $where);

    /**
     * Retrieve all data of repository, paginated
     *
     * @param null $limit
     *
     * @return mixed
     */
    public function paginate($limit = null);

    /**
     * Save a new entity in repository
     *
     * @param array $attributes
     *
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Update a entity in repository by id
     *
     * @param array $attributes
     * @param       $id
     *
     * @return mixed
     */
    public function update(array $attributes, $id);

    /**
     * Delete a entity in repository by id
     *
     * @param $id
     *
     * @return int
     */
    public function delete($id);
}
