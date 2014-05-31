<?php

use Carbon\Carbon;

class HomeController extends BaseController {

	public function home()
	{
        if(Sentry::check())
        {
            return Redirect::to('dashboard');
        }
        else
        {
    		return View::make('front.home');
        }
	}

    public function explore()
    {
        $userRepo = App::make('Gruik\Repo\User\UserInterface');
        $postRepo = App::make('Gruik\Repo\Post\PostInterface');
        $tagRepo = App::make('Gruik\Repo\Tag\TagInterface');

        $limit = Input::get('limit', 15);

        $posts = $postRepo->allPublicQuery()
                    ->with('tags')
                    ->with(['user' => function($q) {
                        $q->select('id', 'username');
                    }])
                    ->orderBy('created_at', 'DESC')
                    ->paginate($limit);

        $posts->each(function($post) {
            $diff = Carbon::now()->diffInMinutes(Carbon::parse($post->created_at));
            $post->created_at_human = Carbon::now()->subMinutes($diff)->diffForHumans();
        });

        JavaScript::put([
            'posts'      => $posts->toArray(),
        ]);

        return View::make('front.explore')
                    ->with('posts', $posts)
                    ->with('user', Sentry::getUser());
    }

    public function login()
    {
        return View::make('front.login');
    }

    public function register()
    {
        return View::make('front.register');
    }

	public function forgotPassword()
	{
		return View::make('front.forgot');
	}

	public function passwordReset($token)
	{
		if ($token)
		{
			return View::make('front.reset_password')
                        ->withToken($token);
		}

		App::abort(404);
	}

}
