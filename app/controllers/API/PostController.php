<?php namespace API;

use \Input;

class PostController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            $postRepo = \App::make('Gruik\Repo\Post\PostInterface');
            return $postRepo->byUserIdQuery(\Sentry::getUser()->id)
                ->with('tags')
                ->get();
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
               //
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
            $postRepo = \App::make('Gruik\Repo\Post\PostInterface');
            $tagRepo = \App::make('Gruik\Repo\Tag\TagInterface');

            $data = [
                'user_id' => \Sentry::getUser()->id,
                'title' => Input::get('title', ''),
                'md_content' => Input::get('md_content', ''),
                'private' => Input::get('private', false),
                'allow_comments' => Input::get('allow_comments', false)
            ];

            $tags = Input::get('tags', []);
            $tagsId = $tagRepo->labelToId($tags, \Sentry::getUser()->id);

            $post = $postRepo->store($data);
            $tags = $postRepo->syncTags($post->id, $tagsId);

            return \Response::json($post, 200);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
            $postRepo = \App::make('Gruik\Repo\Post\PostInterface');
            return $postRepo->byId($id);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $postRepo = \App::make('Gruik\Repo\Post\PostInterface');
        $tagRepo = \App::make('Gruik\Repo\Tag\TagInterface');

        $post = $postRepo->byId($id);

        if($post && $post->user_id == \Sentry::getUser()->id)
        {
            $data = [
                'id' => $id,
                'user_id' => \Sentry::getUser()->id,
                'title' => Input::get('title', ''),
                'md_content' => Input::get('md_content', ''),
                'private' => Input::get('private', false),
                'allow_comments' => Input::get('allow_comments', false)
            ];

            // Save post
            $post = $postRepo->store($data);

            // Sync tags
            $tags = Input::get('tags', []);
            $tagsId = $tagRepo->labelToId($tags, \Sentry::getUser()->id);
            $tags = $postRepo->syncTags($post->id, $tagsId)->toArray();

            $tags_string = array_map(function($tag) {
                return $tag['label'];
            }, $tags);

            $post = $post->toArray();
            $post['tags'] = $tags_string;

            return \Response::json($post, 200);
        }
        else
        {
            return \Response::json("Unauthorized : Post doesn't exist OR user is not allowed to modify this post", 400);
        }
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$postRepo = \App::make('Gruik\Repo\Post\PostInterface');
        $post = $postRepo->byId($id);

        if($post && $postRepo->haveThisOwner($id, \Sentry::getUser()->id))
        {
            $postRepo->deleteById($id);
            return \Response::json([], 200);
        }
        else
        {
            return \Response::json("Unauthorized : Post doesn't exist OR user is not allowed to modify this post", 400);
        }
	}

    public function multiple_delete()
    {
        $postRepo = \App::make('Gruik\Repo\Post\PostInterface');
        $ids = Input::get('ids', []);

        if($ids && $postRepo->haveThisOwner($ids, \Sentry::getUser()->id))
        {
            $postRepo->deleteById($ids);
            return \Response::json([], 200);
        }
        else
        {
            return \Response::json("Unauthorized : Posts don't exist OR user is not allowed to modify these posts", 400);
        }
    }

    public function search()
    {
        $term = Input::get('term', false);
        $tags = Input::get('tags', false);

        $postRepo = \App::make('Gruik\Repo\Post\PostInterface');
        $posts = [];

        if($term)
        {
            $term = trim($term);
            $posts = $postRepo->searchByTerm($term, \Sentry::getUser()->id);
        }

        if($tags)
        {

        }

        return \Response::json($posts, 200);
    }
}
