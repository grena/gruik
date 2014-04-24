<?php namespace Gruik\Repo\User;

use Gruik\Repo\RepoAbstract;
use Gruik\Repo\RepoInterface;

class EloquentUser extends RepoAbstract implements RepoInterface, UserInterface {

    public function __construct(Model $user)
    {
        $this->model = $user;
    }
}