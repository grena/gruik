<?php namespace Gruik\Repo;

/*
|--------------------------------------------------------------------------
| Abstract repository
|--------------------------------------------------------------------------
|
| All repositories of the application extends from it.
|
*/

abstract class RepoAbstract implements RepoInterface {

    protected $model;

    /*
    |--------------------------------------------------------------------------
    | Make a new model entity
    |--------------------------------------------------------------------------
    */
    public function make( array $attributes = array() )
    {
        return $this->model->newInstance( $attributes );
    }
}