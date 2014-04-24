<?php namespace Gruik\Repo\Post;

use Gruik\Repo\RepoAbstract;
use Gruik\Repo\RepoInterface;

class EloquentPost extends RepoAbstract implements RepoInterface, PostInterface {

    public function __construct(Model $post)
    {
        $this->model = $post;
    }
}