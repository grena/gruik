<?php

namespace Gruik\Repo\Post;

use Gruik\Repo\RepoAbstract;
use Gruik\Repo\RepoInterface;
use \Post;
use \DB;

/**
 * Eloquent Repository for Post models.
 *
 * @author Adrien Pétremann <petremann.adrien@gmail.com>
 */
class EloquentPost extends RepoAbstract implements RepoInterface, PostInterface {

    /**
     * Constructor.
     *
     * @param Post $model A Post instance
     */
    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    /**
     * Get posts models where author id is $user_id.
     *
     * @param  int $user_id The id of user (user)
     *
     * @return Illuminate\Database\Eloquent\Collection Result posts of query
     */
    public function byUserId($user_id)
    {
        return $this->byUserIdQuery($user_id)->get();
    }

    /**
     * Build a posts query where author is $user_id and returns it.
     *
     * @param  int $user_id The id of author (user)
     *
     * @return Illuminate\Database\Eloquent\Builder A builder with author id
     */
    public function byUserIdQuery($user_id)
    {
        return $this->model->where('user_id', $user_id);
    }

    /**
     * Build a posts query for public posts and returns it.
     *
     * @return Illuminate\Database\Eloquent\Builder A builder with private is false
     */
    public function allPublicQuery()
    {
        return $this->model->where('private', false);
    }

    /**
     * Synchronize all Tags with id in $tags_id to Post where id is $id_post
     *
     * @param  int $id_post The id of Post
     * @param  array $tags_id Ids of tags to link to the Post
     *
     * @return Illuminate\Support\Collection List of Tags for the post after sync
     */
    public function syncTags($id_post, $tags_id)
    {
        $post = $this->model->find($id_post);
        $existing_tags = $post->tags;

        $existing_id = [];

        foreach ($existing_tags as $tag) {
            $existing_id[] = $tag->id;
        }

        foreach ($existing_id as $id) {
            if (! in_array($id, $tags_id)) {
                $post->tags()->detach($id);
            }
        }

        foreach ($tags_id as $id) {
            if (! in_array($id, $existing_id)) {
                $post->tags()->attach($id);
            }
        }

        return $post->tags;
    }

    /**
     * Update or Create a Post model with $data as attributes, and saves it in database.
     *
     * @param  array $data Values of attributes the Post will be filled with
     *
     * @return Post The saved Post object
     */
    public function store($data)
    {
        $id = array_get($data, 'id', false);

        if ($id) {
            $post = $this->model->find($id)->fill($data);
        } else {
            $post = $this->model->newInstance($data);
        }

        $post->save();

        return $post;
    }

    /**
     * Check in database if Posts with id in $id_posts have author id = $id_owner.
     *
     * @param  mixed $id_posts Array or int, ids of posts to check
     * @param  int $id_owner The user id
     *
     * @return bool True if all posts have this owner, False otherwise.
     */
    public function haveThisOwner($id_posts, $id_owner)
    {
        $id_posts = (array) $id_posts;

        if ($id_posts) {
            return DB::table('posts')
                ->whereIn('id', $id_posts)
                ->where('user_id', $id_owner)
                ->count() === count($id_posts);
        }
    }

    /**
     * Deletes a Post in database where id in $id_posts
     *
     * @param  mixed $id_posts Array or int, id of Post(s) to delete
     */
    public function deleteById($id_posts)
    {
        $id_posts = (array) $id_posts;

        if ($id_posts) {
            DB::table('posts')
                ->whereIn('id', $id_posts)
                ->delete();
        }
    }

    /**
     * Search in database Posts where $term appears in content or title, and if
     * $id_user is the author of posts.
     *
     * @param  string $term Text to search
     * @param  integer $id_user Id of author
     *
     * @return Illuminate\Database\Eloquent\Collection Result posts of query with their tags
     */
    public function searchByTerm($term, $id_user = 0)
    {
        return $request->searchByTermQuery($term, $id_user)->get();
    }

    /**
     * Build a posts query where $term appears in content or title, and if
     * $id_user is the author of posts.
     *
     * @param  string $term Text to search
     * @param  integer $id_user Id of author
     *
     * @return Illuminate\Database\Eloquent\Builder The query builder
     */
    public function searchByTermQuery($term, $id_user = 0)
    {
        $request = $this->model->where(function ($q) use($term) {
            return $q->where('md_content', 'LIKE', '%'.$term.'%')
                    ->orWhere('title', 'LIKE', '%'.$term.'%');
        });

        if ($id_user !== 0) {
            $request->where('user_id', $id_user);
        }

        $request->with('tags')
            ->with('user');

        return $request;
    }
}