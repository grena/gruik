<?php namespace Gruik\Repo;

use Illuminate\Support\ServiceProvider;

use Gruik\Repo\User\EloquentUser;
use \User;
use Gruik\Repo\Post\EloquentPost;
use \Post;
use Gruik\Repo\Tag\EloquentTag;
use \Tag;

class RepoServiceProvider extends ServiceProvider {

    public function register()
    {
        $app = $this->app;

        $app->bind('Gruik\Repo\User\UserInterface', function($app)
        {
            return new EloquentUser(new User);
        });

        $app->bind('Gruik\Repo\Post\PostInterface', function($app)
        {
            return new EloquentPost(new Post);
        });

        $app->bind('Gruik\Repo\Tag\TagInterface', function($app)
        {
            return new EloquentTag(new Tag);
        });

    }
}