<?php namespace Gruik\Repo\User;

use Gruik\Repo\RepoAbstract;
use Gruik\Repo\RepoInterface;

use \User;

class EloquentUser extends RepoAbstract implements RepoInterface, UserInterface {

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function byId($id)
    {
        return \Sentry::findUserById($id);
    }
}