<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    /**      
     * @var Model      
     */
    protected $model;

    /**
     * order
     *
     * @var undefined
     */
    protected $order = null;

    /**      
     * BaseRepository constructor.      
     *      
     * @param Model $model      
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * BaseRepository create method
     * 
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * find
     *
     * @param  mixed $id
     * @return void
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    public function update($id, array $newDetails)
    {
        return  $this->model->find($id)->update($newDetails);
    }

    /**
     * findAll
     *
     * @return void
     */
    public function findAll()
    {
        return $this->model->all();
    }

    /**
     * findAllPaginated
     *
     * @param  mixed $relations
     * @param  mixed $paginate
     * @return void
     */
    public function findAllPaginated($relations = array(), $paginate = 15)
    {
        $model = $this->model;
        if ($this->order != null) {
            $model = $model->orderBy($this->order[0], $this->order[1]);
        }

        //eager load relations
        foreach ($relations as $relation) {
            $model->with($relation);
        }

        return $model->paginate($paginate);
    }
}
