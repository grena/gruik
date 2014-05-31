<?php namespace Gruik\Repo\Post;

use Gruik\Repo\RepoAbstract;
use Gruik\Repo\RepoInterface;

use \Post;

class EloquentPost extends RepoAbstract implements RepoInterface, PostInterface {

    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    public function byUserId($user_id)
    {
        return $this->byUserIdQuery($user_id)->get();
    }

    public function byUserIdQuery($user_id)
    {
        return $this->model->where('user_id', $user_id);
    }

    public function allPublicQuery()
    {
        return $this->model->where('private', false);
    }

    public function syncTags($id_post, $tags_id)
    {
        $post = $this->model->find($id_post);
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

        return $post->tags;
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

    public function haveThisOwner($id_posts, $id_owner)
    {
        $id_posts = (array) $id_posts;

        if($id_posts)
        {
            return \DB::table('posts')->whereIn('id', $id_posts)->where('user_id', $id_owner)->count() === count($id_posts);
        }
    }

    public function deleteById($id_posts)
    {
        $id_posts = (array) $id_posts;

        if($id_posts)
        {
            \DB::table('posts')->whereIn('id', $id_posts)->delete();
        }
    }

    public function searchByTerm($term, $id_user = 0)
    {
        $request = $this->model->where(function($q) use($term) {
            return $q->where('md_content', 'LIKE', '%'.$term.'%')
                    ->orWhere('title', 'LIKE', '%'.$term.'%');
        });

        if($id_user !== 0)
        {
            $request->where('user_id', $id_user);
        }

        $request->with('tags');

        return $request->get();
    }
}