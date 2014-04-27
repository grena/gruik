<?php namespace Gruik\Repo\Post;

use Gruik\Repo\RepoAbstract;
use Gruik\Repo\RepoInterface;

use \Post;

class EloquentPost extends RepoAbstract implements RepoInterface, PostInterface {

    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    public function byId($id)
    {
        return $this->model->find($id);
    }

    public function byUserId($user_id)
    {
        return $this->model->where('user_id', $user_id)->get();
    }

    public function syncTags($id, $tags_id)
    {
        $post = $this->model->find($id);
        $existing_tags = $post->tags;

        $existing_id = [];

        foreach($existing_tags as $tag)
        {
            $existing_id[] = $tag->id;
        }

        // Clean
        foreach($existing_id as $id)
        {
            if(!in_array($id, $tags_id))
            {
                $post->tags()->detach($id);
            }
        }

        // Add new
        foreach($tags_id as $id)
        {
            if(!in_array($id, $existing_id))
            {
                $post->tags()->attach($id);
            }
        }

        return $post;
    }

    public function store($data)
    {
        $id = array_get($data, 'id', false);

        if($id)
        {
            $post = $this->model->find($id)->fill($data);
        }
        else
        {
            $post = $this->model->newInstance($data);
        }

        $post->save();

        return $post;
    }
}