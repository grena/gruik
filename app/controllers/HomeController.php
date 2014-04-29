<?php

class HomeController extends BaseController {

	public function home()
	{
        $postRepo = \App::make('Gruik\Repo\Post\PostInterface');

        $posts = $postRepo->byUserId(1);

		return View::make('front.home')
					->with('posts', $posts);
	}

	public function view($id)
	{
        $postRepo = \App::make('Gruik\Repo\Post\PostInterface');

        $post = $postRepo->byId($id);

		return View::make('front.view')
					->with('post', $post);
	}

}
