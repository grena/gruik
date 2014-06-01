<?php

use Carbon\Carbon;

class UserController extends BaseController {

    public function profile($username)
    {
        $visited_user = User::where('username', $username)->first();

        if( !$visited_user)
            return Redirect::to('/');

        $userRepo = App::make('Gruik\Repo\User\UserInterface');
        $postRepo = App::make('Gruik\Repo\Post\PostInterface');
        $tagRepo = App::make('Gruik\Repo\Tag\TagInterface');

        $limit = Input::get('limit', 20);

        $posts = $postRepo->byUserIdQuery($visited_user->id)
                    ->where('private', false)
                    ->with('tags')
                    ->paginate($limit);

        JavaScript::put([
            'user'       => $userRepo->toPublicArray($visited_user),
            'posts'      => $posts->toArray(),
            'total_tags' => $tagRepo->publicByUserId($visited_user->id)->count(),
            'total_days' => Carbon::now()->diffInDays(Carbon::parse($visited_user->created_at)),
        ]);

        return View::make('front.user_profile')
                    ->with('user', Sentry::getUser())
                    ->with('posts', $posts)
                    ->with('visited_user', $visited_user)
                    ->with('username', $username);
    }

}