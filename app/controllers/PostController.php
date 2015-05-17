<?php

use Carbon\Carbon;

class PostController extends BaseController {

    public function edit()
    {
        $tagRepo = App::make('Gruik\Repo\Tag\TagInterface');
        $postRepo = App::make('Gruik\Repo\Post\PostInterface');
        $userRepo = App::make('Gruik\Repo\User\UserInterface');

        $id_edit = Input::get('edit', false);

        $user = Sentry::getUser();
        $user->preferences = $userRepo->getPreferencesForUser($user->id);

        if($id_edit)
        {
            $post = $postRepo->byId($id_edit)->toArray();
            $tags = $tagRepo->byPostId($id_edit)->toArray();

            $tags_string = array_map(function($tag) {
                return $tag['label'];
            }, $tags);

            // Boo-boo-boolean
            $post['private'] = $post['private'] == "1" ? true : false;
            $post['allow_comments'] = $post['allow_comments'] == "1" ? true : false;

            JavaScript::put([
                'edited_post' => $post,
                'edited_tags' => $tags_string
            ]);
        }

        $tags = $tagRepo->byUserId($user->id)->toArray();

        $tags_string = array_map(function($tag) {
            return ['label' => $tag['label']];
        }, $tags);

        JavaScript::put([
            'tags' => $tags_string,
            'user' => $user
        ]);

        return View::make('auth.create')
                    ->with('user', $user)
                    ->with('tags', $tags);
    }

    public function dashboard()
    {
        $postRepo = App::make('Gruik\Repo\Post\PostInterface');

        $limit = Input::get('limit', 15);

        $posts = $postRepo->byUserIdQuery(Sentry::getUser()->id)
                    ->with('tags')
                    ->orderBy('created_at', 'desc')
                    ->paginate($limit);

        $posts->each(function($post) {
            $diff = Carbon::now()->diffInMinutes(Carbon::parse($post->created_at));
            $post->created_at_human = Carbon::now()->subMinutes($diff)->diffForHumans();
        });

        JavaScript::put([
            'posts' => $posts->toArray()
        ]);

        return View::make('auth.dashboard')
                    ->with('user', Sentry::getUser())
                    ->with('limit', $limit)
                    ->with('posts', $posts);
    }

    public function view($id)
    {
        $postRepo = App::make('Gruik\Repo\Post\PostInterface');

        JavaScript::put([
            'disqus_username' => Config::get('gruik.disqus_username'),
            'post' => $postRepo->byId($id)
        ]);

        $post = $postRepo->byId($id);

        $diff = Carbon::now()->diffInMinutes(Carbon::parse($post->updated_at));
        $post->updated_at_human = Carbon::now()->subMinutes($diff)->diffForHumans();

        return View::make('front.view')
                    ->with('user', Sentry::getUser())
                    ->with('author', $post->user)
                    ->with('post', $post);
    }

}
